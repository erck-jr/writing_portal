<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true',
    viewMode: localStorage.getItem('viewMode') || 'gallery',
    bookmarks: JSON.parse(localStorage.getItem('bookmarks') || '[]'),
    toggleBookmark(postId) {
        if (this.bookmarks.includes(postId)) {
            this.bookmarks = this.bookmarks.filter(id => id !== postId);
        } else {
            this.bookmarks.push(postId);
        }
        localStorage.setItem('bookmarks', JSON.stringify(this.bookmarks));
        
        // Optional: Sync to server if logged in
        if ({{ auth()->check() ? 'true' : 'false' }}) {
            fetch('{{ route('bookmarks.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ post_id: postId })
            });
        }
    }
}" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="@yield('meta_description', 'A minimalist writing portal.')">

    <!-- Favicon -->
    @if(($site_settings['logo_type'] ?? 'text') === 'image' && isset($site_settings['site_logo_image']) && $site_settings['site_logo_image'])
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $site_settings['site_logo_image']) }}">
    @else
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>{{ substr($site_settings['site_logo'] ?? 'W', 0, 1) }}</text></svg>">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white dark:bg-black text-gray-900 dark:text-gray-100 transition-colors duration-300 antialiased" 
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); $watch('viewMode', val => localStorage.setItem('viewMode', val))">
    
    <div class="flex flex-col min-h-screen">
        <x-navbar />

        <main class="flex-1 py-8 sm:py-12">
            @yield('content')
        </main>

        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>
