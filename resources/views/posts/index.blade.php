@extends('layouts.app')

@section('title', isset($category) ? $category->name : (isset($tag) ? '#' . $tag->name : 'Jelajahi Cerita'))

@section('content')
<x-container>
    <div class="mb-12">
        @if(isset($category))
            <span class="text-xs font-black uppercase tracking-widest text-purple-600 mb-2 block italic">Category</span>
            <h1 class="text-5xl font-black italic tracking-tighter">{{ $category->name }}</h1>
        @elseif(isset($tag))
            <span class="text-xs font-black uppercase tracking-widest text-teal-500 mb-2 block italic">Tag</span>
            <h1 class="text-5xl font-black italic tracking-tighter">#{{ $tag->name }}</h1>
        @else
            <h1 class="text-5xl font-black italic tracking-tighter">Jelajahi Cerita</h1>
        @endif
        <p class="mt-4 text-gray-500 dark:text-gray-400 max-w-xl">
            Telusuri koleksi cerita dan ide yang dikurasi khusus untuk kenyamanan membaca Anda.
        </p>
    </div>

    <!-- Toolbar -->
    <div class="flex items-center justify-between mb-10 pb-6 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-4">
            <x-toggle-button @click="viewMode = 'gallery'" ::active="viewMode === 'gallery'">
                <span class="material-icons text-xl">grid_view</span>
            </x-toggle-button>
            <x-toggle-button @click="viewMode = 'list'" ::active="viewMode === 'list'">
                <span class="material-icons text-xl">view_list</span>
            </x-toggle-button>
        </div>

        <div class="flex items-center gap-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
            <span>{{ $posts->total() }} hasil</span>
        </div>
    </div>

    <!-- Posts Grid/List -->
    <div x-show="viewMode === 'gallery'" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="col-span-full py-20 text-center text-gray-400 italic">Belum ada cerita di sini.</div>
        @endforelse
    </div>

    <div x-show="viewMode === 'list'" x-cloak class="space-y-6 max-w-4xl mx-auto">
        @forelse($posts as $post)
            <x-post-list-item :post="$post" />
        @empty
            <div class="py-20 text-center text-gray-400 italic">Belum ada cerita di sini.</div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-20">
        {{ $posts->links() }}
    </div>
</x-container>
@endsection
