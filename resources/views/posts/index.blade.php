<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un nouveau post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-purple-800 mb-4">Créer un nouveau post</h2>
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-semibold text-gray-700">Titre</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-semibold text-gray-700">Contenu</label>
                        <textarea id="content" name="content" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
                    </div>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">Créer
                        le post</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div id="editPostModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Modifier le post</h2>
            <form id="editPostForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="editTitle" class="block text-gray-700 font-semibold mb-2">Titre</label>
                        <input type="text" id="editTitle" name="title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="editContent" class="block text-gray-700 font-semibold mb-2">Contenu</label>
                        <textarea id="editContent" name="content" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                            Annuler
                        </button>
                        <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                            Sauvegarder
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Display Posts -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-xl font-bold text-purple-800 mb-4">Mes posts</h2>

            @foreach ($posts as $post)
                <div class="bg-white rounded-lg shadow-lg p-6 relative mb-6">
                    <div class="absolute top-4 right-4 flex space-x-2">
                        <!-- Button to trigger edit modal -->
                        <button
                            onclick="openEditModal('{{ $post->id }}', '{{ $post->title }}', '{{ $post->content }}')"
                            class="text-purple-500 hover:text-purple-600">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- Delete Post Form -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-pink-500 hover:text-pink-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <h3 class="text-lg font-semibold text-purple-700 mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $post->content }}</p>
                    <div class="text-sm text-gray-500">
                        Publié le {{ $post->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>

<script>
    // Function to open the edit modal and populate it with post data
    function openEditModal(postId, title, content) {
        // Set the action for the form to the correct route for updating the post
        const form = document.getElementById('editPostForm');
        form.action = `/posts/${postId}`;

        // Populate the modal input fields with the current post data
        document.getElementById('editTitle').value = title;
        document.getElementById('editContent').value = content;

        // Show the modal
        document.getElementById('editPostModal').classList.remove('hidden');
    }

    // Function to close the edit modal
    function closeEditModal() {
        document.getElementById('editPostModal').classList.add('hidden');
    }
</script>
