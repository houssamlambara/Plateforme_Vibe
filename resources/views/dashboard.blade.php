<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Utilisateurs') }}
        </h2>
    </x-slot>

    <!-- Profile Section -->
    <div class="flex justify-center items-center min-h-screen bg-gray-800">
        <div
            class="max-w-2xl w-full bg-gray-200 rounded-lg shadow-lg overflow-hidden flex flex-col items-center justify-center">
            <div class="relative px-6 py-8 w-full">
                <!-- Profile Picture -->
                <div class="relative -mt-24 mb-4 flex justify-center items-center">
                    <div class="mt-4 w-20 h-20">
                        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                            alt="profile"
                            class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover">
                    </div>
                </div>
            </div>

            <!-- Name and Bio -->
            <div class="text-center mb-6 w-full">
                <div class="flex justify-center items-center mb-2">
                    <h1 class="text-3xl font-extrabold text-purple-900">{{ $user->name }}</h1>
                    <button class="ml-2 text-pink-500 hover:text-pink-700 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                <p class="text-gray-700 text-xl">@ {{ $user->pseudo }}</p>
            </div>

            <!-- Bio Section -->
            <div class="bg-pink-50 p-6 rounded-lg mb-6 relative w-full shadow-md">
                <button class="absolute top-2 right-2 text-pink-500 hover:text-pink-700 transition-colors duration-200">
                    <i class="fas fa-edit"></i>
                </button>
                <h2 class="text-xl font-semibold text-purple-800 mb-2 text-center">Bio{{ $user->bio}}</h2>
                <p class="text-gray-600 text-center"></p>
            </div>

            <!-- Additional Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                <div class="bg-purple-50 p-6 rounded-lg relative shadow-md">
                    <button
                        class="absolute top-2 right-2 text-purple-500 hover:text-purple-700 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                    </button>
                    <h3 class="font-semibold text-purple-700 mb-2 text-center text-lg">Informations de contact</h3>
                    <ul class="space-y-4 text-gray-700 text-center">
                        <li><i class="fas fa-envelope mr-2 text-purple-600">{{ $user->email }}</i></li>
                        <li><i class="fas fa-phone mr-2 text-purple-600"></i>{{$user->phone}}</li>
                    </ul>
                </div>

                <div class="bg-pink-50 p-6 rounded-lg relative shadow-md">
                    <button
                        class="absolute top-2 right-2 text-pink-500 hover:text-pink-700 transition-colors duration-200">
                        <i class="fas fa-edit"></i>
                    </button>
                    <h3 class="font-semibold text-purple-700 mb-2 text-center text-lg">Réseaux sociaux</h3>
                    <ul class="space-y-4 text-gray-700 text-center">
                        <li><i class="fab fa-twitter mr-2 text-blue-500"></i>@mariedupont</li>
                        <li><i class="fab fa-linkedin mr-2 text-blue-700"></i>marie-dupont</li>
                        <li><i class="fab fa-instagram mr-2 text-pink-600"></i>@marie.creative</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
