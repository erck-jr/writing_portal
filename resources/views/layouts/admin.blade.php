<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif Admin - {{ config('app.name', 'Laravel') }}</title>

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
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-black text-gray-900 dark:text-gray-100 transition-colors duration-300" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden md:block">
            <div class="p-6 flex items-center gap-3">
                @if(($site_settings['logo_type'] ?? 'text') === 'image' && isset($site_settings['site_logo_image']) && $site_settings['site_logo_image'])
                    <img src="{{ asset('storage/' . $site_settings['site_logo_image']) }}" class="h-8 w-auto">
                @else
                    <span class="text-3xl font-black tracking-tighter text-black dark:text-white">
                        @php
                            $logo = $site_settings['site_logo'] ?? 'WP';
                            $first = substr($logo, 0, 1);
                            $rest = substr($logo, 1);
                        @endphp
                        {{ $first }}<span class="text-purple-600">{{ $rest }}</span>
                    </span>
                @endif
                <span class="text-xs font-bold uppercase tracking-widest text-purple-600 bg-purple-100 dark:bg-purple-900/30 px-2 py-0.5 rounded">Admin</span>
            </div>
            
            <nav class="mt-6 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">dashboard</span> Dasbor
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.posts.*') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">article</span> Artikel
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.categories.*') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">category</span> Kategori
                </a>
                <a href="{{ route('admin.tags.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.tags.*') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">tag</span> Tag
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.settings.*') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">settings</span> Pengaturan Web
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('profile.edit') ? 'bg-purple-600 text-white' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-icons text-xl">person</span> Profil Saya
                </a>
            </nav>
            
            <div class="absolute bottom-8 px-8 w-64">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-gray-100 dark:bg-gray-800">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-700">
                    <div class="truncate">
                        <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen">
            <!-- Header -->
            <header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-6 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span class="material-icons">menu</span>
                    </button>
                    <h1 class="font-bold text-lg">@yield('title', 'Admin Dashboard')</h1>
                </div>
                
                <div class="flex items-center gap-3">
                    <x-toggle-button @click="darkMode = !darkMode">
                        <span x-show="!darkMode" class="material-icons">dark_mode</span>
                        <span x-show="darkMode" class="material-icons">light_mode</span>
                    </x-toggle-button>
                    <a href="{{ url('/') }}" target="_blank" class="p-2 text-gray-500 hover:text-teal-500 dark:hover:text-teal-400">
                        <span class="material-icons">visibility</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500">
                            <span class="material-icons">logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <div class="p-6 lg:p-8 flex-1">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-400 rounded-2xl flex items-center gap-3">
                        <span class="material-icons">check_circle</span>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#9333ea',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</body>
</html>
