<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 drop-shadow-md">
            {{ __('Gestion des publications') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-8">

        <!-- Section Utilisateurs -->
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-200 text-center mt-4">Utilisateurs</h2>
        <div class="space-y-6">
            @foreach ($users as $user)
                <div
                    class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 flex justify-between items-center transition hover:shadow-lg">

                    <!-- Affichage de la photo de profil de l'utilisateur -->
                    <div class="flex items-center space-x-4">
                        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                            alt="{{ $user->name }}'s profile picture" class="w-12 h-12 rounded-full object-cover">
                        <div class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ $user->name }}</div>
                    </div>

                    <div>
                        <!-- Vérifier si une demande d'ami existe déjà -->
                        @if (auth()->user()->sentRequests()->where('receiver_id', $user->id)->where('status', 'pending')->exists())
                            <button disabled class="px-5 py-2 bg-gray-400 text-white rounded-full shadow-md">
                                Demande envoyée
                            </button>
                        @else
                            <form action="{{ route('friends.sendRequest', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-5 py-2 bg-blue-500 text-white rounded-full shadow-md hover:bg-blue-600 transition">
                                    Envoyer une demande
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bouton pour annuler les demandes envoyées -->
        <form action="{{ route('friends.cancelSentRequests') }}" method="POST">
            @csrf
            <button type="submit"
                class="px-6 py-3 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 transition duration-300 ease-in-out">
                Annuler les invitations
            </button>
        </form>

        <!-- Section Demandes d'Amis Reçues -->
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-200 text-center mt-4">Demandes d'amis
            reçues</h2>
        <div class="space-y-6">
            @foreach ($pendingRequests as $request)
                <div
                    class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 flex justify-between items-center transition hover:shadow-lg">

                    <!-- Affichage de la photo de profil du demandeur -->
                    <div class="flex items-center space-x-4">
                        <img src="{{ $request->sender->profile_photo ? asset('storage/' . $request->sender->profile_photo) : asset('images/default-avatar.png') }}"
                            alt="{{ $request->sender->name }}'s profile picture"
                            class="w-12 h-12 rounded-full object-cover">
                        <div class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ $request->sender->name }}
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <!-- Formulaire pour accepter la demande -->
                        <form action="{{ route('friends.acceptRequest', $request->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-5 py-2 bg-green-500 text-white rounded-full shadow-md hover:bg-green-600 transition">
                                Accepter
                            </button>
                        </form>

                        <!-- Formulaire pour refuser la demande -->
                        <form action="{{ route('friends.declineRequest', $request->id) }}" method="POST"
                            class="inline">
                            @csrf
                            <button type="submit"
                                class="px-5 py-2 bg-red-500 text-white rounded-full shadow-md hover:bg-red-600 transition">
                                Refuser
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
