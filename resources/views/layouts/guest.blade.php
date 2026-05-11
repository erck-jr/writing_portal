<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-black text-gray-900 dark:text-gray-100 transition-colors duration-300 antialiased" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-8">
                <a href="/" class="flex items-center gap-3">
                    <span class="text-5xl font-black tracking-tighter text-black dark:text-white">
                        {{ $site_settings['site_logo'] ?? 'WP' }}
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-10 py-16 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-2xl shadow-black/5 dark:shadow-white/5 sm:rounded-[3rem] transition-colors relative">
                <div class="absolute top-8 right-8">
                    <x-toggle-button @click="darkMode = !darkMode">
                        <span x-show="!darkMode" class="material-icons">dark_mode</span>
                        <span x-show="darkMode" class="material-icons">light_mode</span>
                    </x-toggle-button>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
