<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Tous les Utilisateurs</h3>

                <ul class="space-y-6"> <!-- Augmenter l'espace entre les éléments de la liste -->
                    @foreach ($users as $user)
                        <li class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow flex items-center space-x-4">
                            <!-- Photo de profil -->
                            <img class="w-12 h-12 rounded-full border-2 border-gray-300 shadow-lg object-cover"
                                src="{{ asset('storage/' . $user->profile_photo) }}" alt="Photo de {{ $user->name }}">

                            <!-- Informations utilisateur -->
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500"><span>@</span>{{ $user->pseudo }}</p>
                            </div>

                            <!-- Bouton pour afficher le profil -->
                            <a href="{{ route('profile.show', $user->id) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 focus:outline-none">
                                Voir le profil
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
