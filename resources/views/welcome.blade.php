<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to Your Social Network</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center">
        <div class="container mx-auto px-4 py-12 text-center">
            <!-- Logo Section -->
            <div class="mb-10">
                <svg class="w-20 h-20 mx-auto" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="25" cy="25" r="20" fill="none" stroke="#4B5563" stroke-width="2"/>
                    <path d="M25 15 A10 10 0 0 1 35 25 A10 10 0 0 1 25 35 A10 10 0 0 1 15 25 A10 10 0 0 1 25 15 Z" fill="none" stroke="#6B7280" stroke-width="2"/>
                    <circle cx="25" cy="20" r="3" fill="#9CA3AF"/>
                    <circle cx="20" cy="25" r="3" fill="#9CA3AF"/>
                    <circle cx="30" cy="25" r="3" fill="#9CA3AF"/>
                    <circle cx="25" cy="30" r="3" fill="#9CA3AF"/>
                </svg>
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-5xl font-bold mb-4 text-white">Connect</h1>
            
            <!-- Subheading -->
            <p class="text-xl max-w-2xl mx-auto mb-10 text-gray-400">
                A minimalist social platform for meaningful connections.
            </p>
            
            <!-- Separator Line -->
            <div class="w-24 h-1 bg-gray-700 mx-auto mb-10"></div>
            
            <!-- Call to Action Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <a href="/register" class="px-8 py-3 bg-gray-800 border border-gray-700 text-white rounded-md font-medium hover:bg-gray-700 transition duration-300">
                    Get Started
                </a>
                <a href="/login" class="px-8 py-3 border border-gray-700 text-gray-400 rounded-md font-medium hover:bg-gray-800 hover:text-white transition duration-300">
                    Sign In
                </a>
            </div>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 max-w-5xl mx-auto">
                <!-- Feature 1 -->
                <div class="bg-gray-800 p-6 rounded-md border border-gray-700 hover:border-gray-600 transition-all duration-300">
                    <div class="text-2xl mb-4 text-gray-400">01</div>
                    <h3 class="text-xl font-semibold mb-2 text-white">Connect</h3>
                    <p class="text-gray-400">Build meaningful relationships with like-minded people.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-800 p-6 rounded-md border border-gray-700 hover:border-gray-600 transition-all duration-300">
                    <div class="text-2xl mb-4 text-gray-400">02</div>
                    <h3 class="text-xl font-semibold mb-2 text-white">Share</h3>
                    <p class="text-gray-400">Share your thoughts and experiences in a distraction-free environment.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-800 p-6 rounded-md border border-gray-700 hover:border-gray-600 transition-all duration-300">
                    <div class="text-2xl mb-4 text-gray-400">03</div>
                    <h3 class="text-xl font-semibold mb-2 text-white">Discover</h3>
                    <p class="text-gray-400">Explore content curated for depth rather than engagement.</p>
                </div>
            </div>
            
            <!-- Stats Section -->
            <div class="flex flex-wrap justify-center gap-12 mt-20 mb-16">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">2M+</div>
                    <div class="text-gray-500 mt-1">Users</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">150+</div>
                    <div class="text-gray-500 mt-1">Countries</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">10M+</div>
                    <div class="text-gray-500 mt-1">Connections</div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="mt-20 text-sm text-gray-600">
                <p>© 2025 Connect. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>