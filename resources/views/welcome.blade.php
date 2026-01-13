<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Smart Brains Media Hub</title>
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Smart Brains Media Hub</h1>
                <p class="text-lg text-gray-600 mb-8">Choose a media type to get started.</p>
            </div>
            <div class="flex space-x-8">
                <a href="{{ route('images.index') }}" class="px-6 py-3 bg-white rounded-lg shadow-md text-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Image Gallery
                </a>
                <a href="{{ route('videos.index') }}" class="px-6 py-3 bg-white rounded-lg shadow-md text-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Video Library
                </a>
            </div>
        </div>
    </body>
</html>