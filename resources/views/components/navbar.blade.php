<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 dark:bg-black/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
    <x-container>
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
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
                </a>

                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('featured.index') }}" class="text-xs font-black uppercase tracking-widest {{ request()->routeIs('featured.index') ? 'text-purple-600' : 'text-gray-500 hover:text-black dark:hover:text-white' }} transition-colors">Artikel Utama</a>
                    
                    <!-- Categories Dropdown -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center gap-1 text-xs font-black uppercase tracking-widest text-gray-500 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                            <span>Semua Cerita</span>
                            <span class="material-icons text-sm transition-transform" :class="dropdownOpen ? 'rotate-180' : ''">expand_more</span>
                        </button>
                        
                        <div x-show="dropdownOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute left-0 mt-4 w-56 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 ring-1 ring-black ring-opacity-5 p-2 z-[60]">
                            
                            <a href="{{ route('posts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors {{ request()->routeIs('posts.index') ? 'bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400' : '' }}">
                                <span class="material-icons text-sm">list</span>
                                Lihat Semua
                            </a>
                            
                            <div class="my-2 border-t border-gray-100 dark:border-gray-800"></div>
                            
                            @foreach(\App\Models\Category::all() as $category)
                                <a href="{{ route('categories.show', $category->slug) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors {{ request()->fullUrl() === route('categories.show', $category->slug) ? 'bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400' : '' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </nav>
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center bg-gray-100 dark:bg-gray-900 rounded-full px-3 py-1.5">
                    <span class="material-icons text-gray-400 text-sm">search</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="bg-transparent border-none focus:ring-0 text-sm w-32 lg:w-48 text-gray-900 dark:text-gray-100">
                </form>

                <x-toggle-button @click="darkMode = !darkMode">
                    <span x-show="!darkMode" class="material-icons">dark_mode</span>
                    <span x-show="darkMode" class="material-icons">light_mode</span>
                </x-toggle-button>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="p-2 text-gray-500 hover:text-teal-500 dark:hover:text-teal-400">
                            <span class="material-icons">dashboard</span>
                        </a>
                    @endif
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-purple-600" src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" alt="">
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-4 w-56 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 ring-1 ring-black ring-opacity-5 p-2 z-[60]">
                            
                            <div class="px-4 py-3 mb-2 border-b border-gray-100 dark:border-gray-800">
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Masuk Sebagai</p>
                                <p class="text-sm font-bold truncate text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <span class="material-icons text-sm">person_outline</span>
                                Profil Saya
                            </a>

                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-teal-600 dark:text-teal-400 hover:bg-teal-50 dark:hover:bg-teal-900/20 transition-colors">
                                    <span class="material-icons text-sm">dashboard</span>
                                    Panel Admin
                                </a>
                            @endif

                            <div class="my-2 border-t border-gray-100 dark:border-gray-800"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <span class="material-icons text-sm">logout</span>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Masuk</a>
                @endauth

                <button @click="open = !open" class="sm:hidden p-2 text-gray-500">
                    <span class="material-icons" x-show="!open">menu</span>
                    <span class="material-icons" x-show="open">close</span>
                </button>
            </div>
        </div>
    </x-container>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden bg-white dark:bg-black border-t border-gray-200 dark:border-gray-800 py-2 px-4 space-y-1">
        <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900">Beranda</a>
        @foreach(\App\Models\Category::all() as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900">{{ $category->name }}</a>
        @endforeach
    </div>
</nav>