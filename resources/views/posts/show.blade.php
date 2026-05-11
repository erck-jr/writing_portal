@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
<x-reading-progress />

<x-container x-data="{ readingMode: false }">
    <div :class="{ 'max-w-3xl mx-auto': readingMode }">
        <!-- Breadcrumbs / Meta -->
        <div class="flex items-center gap-3 text-xs font-black uppercase tracking-widest text-purple-600 mb-8 italic" x-show="!readingMode">
            <a href="{{ url('/') }}" class="hover:underline">Beranda</a>
            <span class="material-icons text-[10px] text-gray-300">chevron_right</span>
            <a href="{{ route('categories.show', $post->category->slug) }}" class="hover:underline">{{ $post->category->name }}</a>
        </div>

        <!-- Title Section -->
        <header class="mb-12">
            <h1 class="text-4xl md:text-6xl font-black italic tracking-tighter leading-tight mb-8">
                {{ $post->title }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-between gap-6 pb-8 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-4">
                    <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" class="w-12 h-12 rounded-2xl border-2 border-purple-600 shadow-lg shadow-purple-500/10">
                    <div>
                        <p class="text-sm font-black italic tracking-tight">{{ $post->user->name }}</p>
                        <p class="text-xs text-gray-400">{{ $post->published_at->format('d F Y') }} • {{ $post->reading_time }} menit baca</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    <x-toggle-button @click="readingMode = !readingMode" title="Mode Baca">
                        <span class="material-icons">auto_stories</span>
                    </x-toggle-button>
                    <x-toggle-button @click="toggleBookmark({{ $post->id }})" title="Simpan Artikel" ::active="bookmarks.includes({{ $post->id }})">
                        <span class="material-icons" x-text="bookmarks.includes({{ $post->id }}) ? 'bookmark' : 'bookmark_border'"></span>
                    </x-toggle-button>
                    <x-toggle-button title="Bagikan">
                        <span class="material-icons">ios_share</span>
                    </x-toggle-button>
                </div>
            </div>
        </header>

        <!-- Cover Image -->
        @if($post->cover_image && !$post->readingMode)
            <div class="mb-16 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-black/10 dark:shadow-white/5 aspect-video" x-show="!readingMode">
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Content -->
        <article class="prose prose-lg md:prose-xl dark:prose-invert max-w-none prose-headings:font-black prose-headings:italic prose-headings:tracking-tight prose-a:text-purple-600 dark:prose-a:text-purple-400 prose-img:rounded-3xl prose-blockquote:border-purple-600 prose-blockquote:bg-purple-50/50 dark:prose-blockquote:bg-purple-900/10" 
                 :class="{ 'text-2xl leading-relaxed': readingMode }">
            {!! $post->content !!}
        </article>

        <!-- Tags -->
        @if($post->tags->count() > 0)
            <div class="mt-16 flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}">
                        <x-badge variant="gray">#{{ $tag->name }}</x-badge>
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Related Posts -->
        <div class="mt-32 pt-16 border-t border-gray-100 dark:border-gray-800" x-show="!readingMode">
            <h3 class="text-3xl font-black italic mb-10 tracking-tight">Artikel Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related_posts as $related)
                    <x-post-card :post="$related" />
                @endforeach
            </div>
        </div>
    </div>
</x-container>
@endsection
