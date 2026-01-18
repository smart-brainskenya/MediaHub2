<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Brains Kenya MediaHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Favicons -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-slate-50 to-slate-100">
        <div class="min-h-screen flex flex-col">
            <!-- Header with Brand -->
            <header class="bg-white shadow-md border-b-4 border-brand-blue">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <a href="/" class="flex items-center space-x-3 group">
                            <img src="{{ asset('logo.svg') }}" alt="Smart Brains Kenya Logo" class="h-10 w-auto group-hover:scale-105 transition-transform duration-200">
                            <span class="text-xl font-bold text-brand-blue group-hover:text-brand-sky transition-colors">{{ config('app.name', 'Smart Brains Kenya Media Hub') }}</span>
                        </a>
                        <nav class="hidden sm:flex space-x-6 text-sm">
                            <a href="/" class="text-slate-700 hover:text-brand-blue font-semibold transition-colors">Home</a>
                            <a href="{{ route('images.index') }}" class="text-slate-700 hover:text-brand-blue font-semibold transition-colors">Images</a>
                            <a href="{{ route('videos.index') }}" class="text-slate-700 hover:text-brand-blue font-semibold transition-colors">Videos</a>
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 py-6 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-slate-600 text-sm">
                        <p>© 2026 Smart Brains Kenya. Building curiosity, one click at a time.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

