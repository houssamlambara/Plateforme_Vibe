<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-3xl font-bold text-center text-purple-700">Ajouter un Nouveau Post</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre</label>
                <input type="text" name="title" id="title" class="w-full p-2 mt-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Contenu</label>
                <textarea name="content" id="content" rows="6" class="w-full p-2 mt-2 border rounded-lg" required></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded-lg">Publier</button>
            </div>
        </form>
    </div>

</body>

</html>
