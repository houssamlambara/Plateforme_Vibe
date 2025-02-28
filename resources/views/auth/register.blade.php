<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Social Network') }} - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: #4A5568;
            box-shadow: 0 0 0 3px rgba(74, 85, 104, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Logo/Brand -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white">Join the Community</h1>
                <p class="text-gray-400 mt-2">Create your account to get started</p>
            </div>
            
            <!-- Form Container -->
            <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                <!-- Form Header -->
                <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                    <h2 class="text-xl font-medium text-white">Personal Information</h2>
                </div>
                
                <!-- Form Body -->
                <div class="p-6">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Two Column Layout for Name and Pseudo -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required autofocus autocomplete="name">
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Pseudo -->
                            <div>
                                <label for="pseudo" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                                <input id="pseudo" type="text" name="pseudo" placeholder="Choose a unique username" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required>
                                @error('pseudo')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Profile Photo Upload -->
                        <div class="mb-6">
                            <label for="photo" class="block text-sm font-medium text-gray-300 mb-1">Profile Photo</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-400">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-gray-200 hover:text-white focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="profile_photo" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            @error('profile_photo')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="border-t border-gray-600 pt-6 pb-4">
                            <h3 class="text-lg font-medium text-white mb-4">Contact Information</h3>
                            
                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required autocomplete="email">
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone Number</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required autocomplete="tel">
                                @error('phone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Security Section -->
                        <div class="border-t border-gray-600 pt-6 pb-4">
                            <h3 class="text-lg font-medium text-white mb-4">Secure Your Account</h3>
                            
                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                                <input id="password" type="password" name="password" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required autocomplete="new-password">
                                <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                                @error('password')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" 
                                    class="form-input w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none" 
                                    required autocomplete="new-password">
                                @error('password_confirmation')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Terms Agreement -->
                        <div class="mt-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="terms" name="terms" type="checkbox" class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-gray-900 focus:ring-gray-500" required>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms" class="text-gray-400">I agree to the <a href="#" class="text-gray-200 hover:text-white">Terms of Service</a> and <a href="#" class="text-gray-200 hover:text-white">Privacy Policy</a></label>
                                </div>
                            </div>
                            @error('terms')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button and Login Link -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition duration-150 ease-in-out">
                                Already have an account?
                            </a>
                            <button type="submit" class="px-5 py-2 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Your Social Network. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>