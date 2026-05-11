@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<x-container>
    <!-- Hero Section -->
    <div class="text-center py-20 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-purple-50/50 to-transparent dark:from-purple-900/10 dark:to-transparent -z-10 rounded-full blur-3xl"></div>
        
        <h1 class="text-5xl md:text-7xl font-black tracking-tighter mb-6 italic">
            {{ $site_settings['welcome_title'] ?? 'Menulis. Terhubung. Berkembang.' }}
        </h1>
        <p class="text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
            {{ $site_settings['welcome_description'] ?? 'Tempat bagi pemikiran minimalist dan ide-ide mendalam.' }}
        </p>
        
        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('posts.index') }}" class="bg-black dark:bg-white text-white dark:text-black px-8 py-4 rounded-2xl font-bold text-sm hover:scale-105 transition-transform shadow-xl shadow-black/10 dark:shadow-white/10">
                Jelajahi Cerita
            </a>
            @guest
                <a href="{{ route('login') }}" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-gray-100 px-8 py-4 rounded-2xl font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Mulai Menulis
                </a>
            @endguest
        </div>
    </div>

    <!-- Featured Posts Carousel -->
    @php
        $featured_posts = \App\Models\Post::published()->featured()->with(['category', 'user'])->latest()->take(3)->get();
    @endphp

    @if($featured_posts->count() > 0)
    <div class="mt-20 relative px-4" x-data="{ active: 0, count: {{ $featured_posts->count() }} }">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black italic tracking-tight flex items-center gap-2">
                <span class="material-icons text-yellow-500">star</span> Artikel Utama
            </h2>
            <div class="flex gap-2">
                <button @click="active = (active - 1 + count) % count" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-800 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <span class="material-icons text-sm">chevron_left</span>
                </button>
                <button @click="active = (active + 1) % count" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-800 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <span class="material-icons text-sm">chevron_right</span>
                </button>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-[3rem] h-[500px]">
            @foreach($featured_posts as $index => $post)
            <div x-show="active === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 w-full h-full">
                <img src="{{ $post->cover_image ? asset('storage/'.$post->cover_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=1200&auto=format&fit=crop' }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-12 text-white">
                    <x-badge variant="turquoise" class="mb-4 w-fit">{{ $post->category->name }}</x-badge>
                    <h3 class="text-4xl md:text-5xl font-black italic tracking-tighter mb-4 max-w-3xl leading-tight">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-purple-400 transition-colors">{{ $post->title }}</a>
                    </h3>
                    <div class="flex items-center gap-4 text-sm font-bold text-gray-300 uppercase tracking-widest">
                        <span>Oleh {{ $post->user->name }}</span>
                        <span>•</span>
                        <span>{{ $post->reading_time }} menit baca</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="flex justify-center mt-6 gap-2">
            @foreach($featured_posts as $index => $post)
            <button @click="active = {{ $index }}" 
                    class="h-1.5 rounded-full transition-all duration-300" 
                    :class="active === {{ $index }} ? 'w-8 bg-purple-600' : 'w-2 bg-gray-300 dark:bg-gray-700'"></button>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Latest Stories -->
    <div class="mt-20">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-black italic tracking-tight">Cerita Terbaru</h2>
            <a href="{{ route('posts.index') }}" class="text-xs font-black uppercase tracking-widest text-purple-600 hover:underline">Lihat semua</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latest_posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    </div>

    <!-- Popular Section (Horizontal Layout) -->
    <div class="mt-32">
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-[3rem] p-8 md:p-16 border border-gray-100 dark:border-gray-800">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-purple-600 mb-4 block">Paling Banyak Dibaca</span>
                    <h2 class="text-4xl font-black italic tracking-tight">Percakapan Populer</h2>
                </div>
                
                <div class="space-y-8">
                    @foreach($popular_posts as $post)
                        <x-post-list-item :post="$post" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Simple -->
    <div class="mt-32 text-center max-w-2xl mx-auto py-20 px-8 bg-teal-50 dark:bg-teal-900/10 rounded-[2.5rem] border border-teal-100/50 dark:border-teal-800/30">
        <h3 class="text-3xl font-black italic mb-4">Tetap terhubung.</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-8">Dapatkan wawasan dan cerita mingguan langsung ke kotak masuk Anda.</p>
        <form class="flex flex-col sm:flex-row gap-3">
            <input type="email" placeholder="email@anda.com" class="flex-1 bg-white dark:bg-black border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-teal-500 transition-all">
            <button type="submit" class="bg-teal-500 text-white font-bold px-8 py-4 rounded-2xl hover:bg-teal-600 transition-colors shadow-lg shadow-teal-500/20">
                Berlangganan
            </button>
        </form>
    </div>
</x-container>
@endsection
