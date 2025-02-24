<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Gestion des publications') }}
        </h2>
    </x-slot>

    <!-- Section Création de Post -->
    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-5 text-center mb-6">Nouvelle
                    publication</h3>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre</label>
                        <input type="text" id="title" name="title"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Entrez un titre accrocheur" required>
                    </div>
                    <div>
                        <label for="content"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contenu</label>
                        <textarea id="content" name="content" rows="5"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Partagez vos idées ici..." required></textarea>
                    </div>
                    <div>
                        <label for="image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ajouter une
                            image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="pt-2 flex justify-center">
                        <button type="submit"
                            class="flex justify-center items-center gap-2 bg-[#1877F2] hover:bg-[#145dbf] text-white font-semibold py-2 px-6 rounded-md shadow-md transition-all duration-200 ease-in-out transform hover:-translate-y-0.5 mt-6">
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Section Liste des Posts -->
    <div class="pb-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-5 text-center">Vos publications</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition duration-200">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">{{ $post->title }}
                            </h4>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-3">{{ $post->content }}</p>

                        <!-- Affichage de l'image si elle existe -->
                        @if ($post->image)
                            <div class="overflow-hidden rounded-lg mt-4">
                                <img class="h-32 w-32 object-cover" src="{{ Storage::url($post->image) }}"
                                    alt="Image du post">
                            </div>
                        @endif

                        <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $post->created_at->format('d/m/Y à H:i') }}
                        </div>

                        <!-- Boutons de modification et suppression centrés -->
                        <div class="flex justify-center gap-4 mt-4">
                            <button data-modal-toggle="modal-edit-{{ $post->id }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                Modifier
                            </button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                    Supprimer
                                </button>
                            </form>
                        </div>

                        <!-- Modal pour modifier -->
                        <div id="modal-edit-{{ $post->id }}" tabindex="-1"
                            class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div
                                    class="relative w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                                    <h3 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-4 text-center">
                                        Modifier la publication</h3>
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Utilise PUT ou PATCH pour la mise à jour -->
                                        <div class="mb-4">
                                            <label for="title"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre</label>
                                            <input type="text" id="title" name="title"
                                                value="{{ $post->title }}"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="content"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contenu</label>
                                            <textarea id="content" name="content" rows="5"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required>{{ $post->content }}</textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="image"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ajouter
                                                une image</label>
                                            <input type="file" id="image" name="image" accept="image/*"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        </div>
                                        <div class="flex justify-end gap-4">
                                            <button type="button"
                                                onclick="document.getElementById('modal-edit-{{ $post->id }}').classList.add('hidden');"
                                                class="bg-gray-500 text-white px-4 py-2 rounded-md">Fermer</button>
                                            <button type="submit"
                                                class="bg-blue-600 text-white px-4 py-2 rounded-md">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
