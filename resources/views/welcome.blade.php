<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yet Another Todo App</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div class="relative min-h-screen bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center">
            <div class="mb-8">
                <i class="fas fa-check-circle text-6xl text-blue-600 mb-4"></i>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Yet Another Todo App
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Organize your tasks efficiently with our Todo App
                </p>
            </div>

            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <p class="text-lg text-gray-700 mb-4">
                            You're currently logged in as <b>{{ Auth::user()->name }}</b>
                        </p>
                        <a href="{{ route('todos.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-white border border-blue-600 rounded-md font-semibold text-blue-600 hover:bg-blue-50 transition">
                                <i class="fas fa-user-plus mr-2"></i>
                                Register
                            </a>
                        @endif
                    @endauth
                        <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 border border-transparent rounded-md font-semibold text-blue-600 hover:bg-gray-200 transition">
                            <i class="fas fa-info-circle mr-1"></i>
                            About
                        </a>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
