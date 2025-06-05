<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="about-container">
    <div class="about-card">
        <!-- Header -->
        <div class="about-header">
            <i class="fas fa-check-circle text-6xl text-white mb-4"></i>
            <h1 class="text-2xl font-bold mb-2">Yet Another Todo App</h1>
            <p class="text-lg opacity-90">An application to manage your tasks</p>
        </div>

        <!-- Content -->
        <div class="about-content">
            <!-- Description -->
            <section class="mb-8">
                <p class="text-gray-700 leading-relaxed mb-4">
                    <b>Yet Another Todo App</b> is a simple web application that allows users to create, read, update, and delete
                    tasks (a.k.a. todos). Written in PHP and utilising PostgreSQL, It is designed to be a lightweight
                    and easy-to-use tool for managing personal tasks and to-do lists.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    This application is built as a final project for the course "Web-Based Programming" at Bina
                    Nusantara University in 2025.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    The source code of this app is available on
                    <a target="_blank" rel="noopener noreferrer" href="https://github.com/einzwell/yetanothertodoapp">
                        <u style="color: #2563eb">GitHub</u>.
                    </a>
                </p>
            </section>

            <!-- Development Credits -->
            <section class="text-center">
                <p class="text-xs text-gray-500 mb-1">
                    Developed by Yoga Smara (<u style="color:cornflowerblue"><a target="_blank" rel="noopener noreferrer" href="https://einzwell.dev">@einzwell</a></u>)
                </p>
                <p class="text-xs text-gray-500">
                    Contributors: Rafli (<u style="color:cornflowerblue"><a target="_blank" rel="noopener noreferrer" href="https://github.com/FLYY27">@FLYY27</a></u>)
                </p>
            </section>

            <!-- Navigation Links -->
            <div class="navigation-links">
                @auth
                    <a href="{{ route('todos.index') }}" class="flex items-center justify-center btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        Login Now
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center btn btn-secondary">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
</body>
</html>
