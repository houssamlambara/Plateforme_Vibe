<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-indigo-800 dark:text-indigo-300">
            {{ __('Gestion des publications') }}
        </h2>
    </x-slot>

    <!-- Section Création de Post -->
    <div class="py-12 max-w-5xl mx-auto px-6 sm:px-8 lg:px-10">
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-indigo-100 dark:border-indigo-900">
            <div class="p-8">
                <h3
                    class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-6 text-center relative before:content-[''] before:absolute before:w-24 before:h-1 before:bg-indigo-500 before:-bottom-2 before:left-1/2 before:-translate-x-1/2">
                    Nouvelle publication</h3>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-8">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    @csrf
                    <div>
                        <label for="title"
                            class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Titre</label>
                        <input type="text" id="title" name="title"
                            class="w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 dark:border-gray-600 dark:text-white transition-all duration-200"
                            placeholder="Entrez un titre accrocheur" required>
                    </div>
                    <div>
                        <label for="content"
                            class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Contenu</label>
                        <textarea id="content" name="content" rows="5"
                            class="w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 dark:border-gray-600 dark:text-white transition-all duration-200"
                            placeholder="Partagez vos idées ici..." required></textarea>
                    </div>
                    <div>
                        <label for="image"
                            class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Ajouter une
                            image</label>
                        <div
                            class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all duration-200">
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full cursor-pointer rounded-lg text-gray-700 dark:text-gray-300">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">JPG, PNG ou GIF. Taille max 5MB</p>
                        </div>
                    </div>
                    <div class="pt-2 flex justify-center">
                        <button type="submit"
                            class="flex justify-center items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Section Liste des Posts -->
    <div class="pb-16 max-w-6xl mx-auto px-6 sm:px-8 lg:px-10">
        <h3
            class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-8 text-center relative before:content-[''] before:absolute before:w-24 before:h-1 before:bg-indigo-500 before:-bottom-2 before:left-1/2 before:-translate-x-1/2">
            Vos publications
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden group hover:shadow-xl transition duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</h4>
                            <div
                                class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1 bg-gray-100 dark:bg-gray-700 py-1 px-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $post->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-3">{{ $post->content }}</p>

                        <!-- Affichage de l'image si elle existe -->
                        @if ($post->image)
                            <div class="overflow-hidden rounded-lg mb-4 border border-gray-200 dark:border-gray-600">
                                <img class="h-48 w-full object-cover transition-transform duration-300 transform group-hover:scale-105"
                                    src="{{ Storage::url($post->image) }}" alt="Image du post">
                            </div>
                        @endif

                        <!-- Boutons de modification et suppression centrés -->
                        <div class="flex justify-center gap-6 mt-6">
                            <button data-modal-toggle="modal-edit-{{ $post->id }}"
                                class="flex items-center gap-1 text-indigo-600 hover:text-indigo-800 font-medium transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1 text-red-600 hover:text-red-800 font-medium transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>

                        <!-- Modal pour modifier -->
                        <div id="modal-edit-{{ $post->id }}" tabindex="-1"
                            class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
                                <div
                                    class="relative w-full max-w-2xl p-8 bg-white rounded-2xl shadow-2xl dark:bg-gray-800 z-10">
                                    <h3
                                        class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-6 text-center">
                                        Modifier la publication
                                    </h3>
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                        enctype="multipart/form-data" class="space-y-6">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="title"
                                                class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Titre</label>
                                            <input type="text" id="title" name="title"
                                                value="{{ $post->title }}"
                                                class="w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 dark:border-gray-600 dark:text-white transition-all duration-200"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="content"
                                                class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Contenu</label>
                                            <textarea id="content" name="content" rows="5"
                                                class="w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 dark:border-gray-600 dark:text-white transition-all duration-200"
                                                required>{{ $post->content }}</textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="image"
                                                class="block text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Ajouter
                                                une image</label>
                                            <div
                                                class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all duration-200">
                                                <input type="file" id="image" name="image" accept="image/*"
                                                    class="w-full cursor-pointer rounded-lg text-gray-700 dark:text-gray-300">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">JPG, PNG ou
                                                    GIF. Taille max 5MB</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-end gap-4 pt-4">
                                            <button type="button"
                                                onclick="document.getElementById('modal-edit-{{ $post->id }}').classList.add('hidden');"
                                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200">Annuler</button>
                                            <button type="submit"
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton Like/Dislike -->
                    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 flex items-center justify-between">
                        <form action="{{ route('posts.toggleLike', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 text-red-500 hover:text-red-700 transition duration-200">

                                <!-- Icône de cœur remplie si liké, vide sinon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="{{ $post->likes->contains('user_id', auth()->id()) ? 'currentColor' : 'none' }}"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>

                                <!-- Texte dynamique : Like ou Dislike -->
                                <span class="font-medium">
                                    {{ $post->likes->count() }}
                                    {{ $post->likes->contains('user_id', auth()->id()) ? 'Dislike' : 'Like' }}
                                </span>
                            </button>
                        </form>
                    </div>


                    <!-- Affichage des commentaires -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                        <form action="{{ route('posts.comment', $post->id) }}" method="POST" class="mb-6">
                            @csrf
                            <textarea name="content" placeholder="Ajouter un commentaire..."
                                class="w-full rounded-xl p-4 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:outline-none transition duration-300 ease-in-out mb-4"
                                rows="2" required></textarea>

                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105 !important">
                                Commenter
                            </button>
                        </form>

                        <!-- Liste des commentaires -->
                        @if (count($post->comments) > 0)
                            <h5 class="font-medium text-gray-800 dark:text-gray-200 mb-4">
                                Commentaires ({{ count($post->comments) }})
                            </h5>
                        @endif

                        @foreach ($post->comments as $comment)
                            <div class="mt-4 border-t border-gray-200 dark:border-gray-600 pt-4">
                                <div class="flex items-center mb-2">
                                    <div
                                        class="h-8 w-8 rounded-full bg-indigo-200 dark:bg-indigo-800 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold mr-2">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <p class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                                        {{ $comment->user->name }}
                                    </p>
                                </div>

                                <!-- Formulaire pour modifier et supprimer le commentaire -->
                                @if ($comment->user_id === auth()->id())
                                    <div class="mb-4">
                                        <!-- Affichage du contenu du commentaire -->
                                        <p class="text-gray-600 dark:text-gray-300 ml-10 mb-2">{{ $comment->content }}
                                        </p>

                                        <!-- Formulaire pour modifier un commentaire -->
                                        <form action="{{ route('comments.update', $comment->id) }}" method="POST"
                                            class="ml-10">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="content"
                                                class="w-full p-3 border rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white mb-2" required>{{ $comment->content }}</textarea>

                                            <div class="flex space-x-2">
                                                <!-- Bouton Modifier -->
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                                                    Modifier
                                                </button>

                                                <!-- Bouton Supprimer (à côté de Modifier) -->
                                                <button type="button" form="delete-form-{{ $comment->id }}"
                                                    class="text-red-500 hover:text-red-700 border border-red-500 py-2 px-4 rounded-lg transition duration-200">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Formulaire pour Supprimer (séparé mais lié au bouton) -->
                                        <form id="delete-form-{{ $comment->id }}"
                                            action="{{ route('comments.delete', $comment->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                @else
                                    <p class="text-gray-600 dark:text-gray-300 ml-10">{{ $comment->content }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Script pour ouvrir et fermer le modal -->
    <script>
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-toggle');
                document.getElementById(modalId).classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
