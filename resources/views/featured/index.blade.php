@extends('layouts.app')

@section('title', 'Artikel Utama')

@section('content')
<x-container>
    <div class="mb-12" x-data="{ viewMode: 'list' }">
        <div class="mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-yellow-500 mb-2 block italic">Pilihan Editor</span>
            <h1 class="text-5xl font-black italic tracking-tighter">Artikel Utama</h1>
            <p class="mt-4 text-gray-500 dark:text-gray-400 max-w-xl">
                Koleksi cerita terbaik yang kami kurasi khusus untuk Anda. Ide-ide mendalam dari penulis pilihan kami.
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
                <div class="col-span-full py-32 text-center bg-gray-50 dark:bg-gray-900 rounded-[3rem] border-2 border-dashed border-gray-100 dark:border-gray-800">
                    <div class="max-w-xs mx-auto">
                        <span class="material-icons text-6xl text-gray-200 dark:text-gray-800 mb-6">star_outline</span>
                        <h3 class="text-xl font-bold mb-2 italic">Belum Ada Artikel Utama</h3>
                        <p class="text-sm text-gray-400">Tim kami sedang mengkurasi cerita terbaik. Kembali lagi nanti!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div x-show="viewMode === 'list'" x-cloak class="space-y-6 max-w-4xl mx-auto">
            @forelse($posts as $post)
                <x-post-list-item :post="$post" />
            @empty
                <div class="py-32 text-center bg-gray-50 dark:bg-gray-900 rounded-[3rem] border-2 border-dashed border-gray-100 dark:border-gray-800">
                    <div class="max-w-xs mx-auto">
                        <span class="material-icons text-6xl text-gray-200 dark:text-gray-800 mb-6">star_outline</span>
                        <h3 class="text-xl font-bold mb-2 italic">Belum Ada Artikel Utama</h3>
                        <p class="text-sm text-gray-400">Tim kami sedang mengkurasi cerita terbaik. Kembali lagi nanti!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</x-container>
@endsection
