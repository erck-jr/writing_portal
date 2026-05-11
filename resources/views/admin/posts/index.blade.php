@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <p class="text-sm text-gray-500 font-medium">Buat, edit, dan kelola semua artikel blog Anda di sini.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="bg-purple-600 text-white px-6 py-3 rounded-2xl font-bold text-sm flex items-center gap-2 hover:bg-purple-700 transition-colors shadow-lg shadow-purple-500/20">
        <span class="material-icons text-sm">add_circle</span> Buat Artikel Baru
    </a>
</div>

<!-- Search & Filters -->
<div class="mb-6 flex flex-col md:flex-row gap-4">
    <form action="{{ route('admin.posts.index') }}" method="GET" class="flex-1 flex gap-2">
        <div class="relative flex-1 group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <span class="material-icons text-gray-400 group-focus-within:text-purple-600 transition-colors text-base">search</span>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl py-3.5 pl-14 pr-4 text-sm focus:ring-4 focus:ring-purple-600/10 focus:border-purple-600 transition-all shadow-sm" 
                   placeholder="Cari judul atau isi artikel...">
        </div>
        <button type="submit" class="bg-black dark:bg-white text-white dark:text-black px-6 rounded-2xl font-bold text-xs uppercase tracking-widest hover:scale-105 transition-all">
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-100 dark:bg-gray-800 text-gray-500 px-6 rounded-2xl font-bold text-xs uppercase tracking-widest flex items-center hover:bg-gray-200 transition-all">
                Reset
            </a>
        @endif
    </form>
</div>

<div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-gray-800/50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <tr>
                    <th class="px-6 py-4">Info Artikel</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-12 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 flex-shrink-0 border border-gray-100 dark:border-gray-700">
                                <img src="{{ $post->cover_image ? asset('storage/'.$post->cover_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=200&auto=format&fit=crop' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 line-clamp-1">{{ $post->title }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[10px] text-gray-400">{{ $post->reading_time }} menit baca</span>
                                    <span class="text-[10px] text-gray-400">•</span>
                                    <span class="text-[10px] text-gray-400">Oleh {{ $post->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <x-badge variant="turquoise">{{ $post->category->name }}</x-badge>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <x-badge :variant="$post->status === 'published' ? 'purple' : 'gray'">{{ $post->status === 'published' ? 'Terbit' : 'Draft' }}</x-badge>
                                @if($post->is_featured)
                                    <span class="material-icons text-yellow-500 text-sm" title="Artikel Utama">star</span>
                                @endif
                            </div>
                            @if($post->published_at)
                                <span class="text-[10px] text-gray-400">{{ $post->published_at->format('d M Y') }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-2 text-gray-400 hover:text-purple-500 transition-colors">
                                <span class="material-icons">edit</span>
                            </a>
                            <button onclick="confirmDelete({{ $post->id }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                <span class="material-icons">delete</span>
                            </button>
                            <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">No posts found. Start writing today!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 dark:border-gray-800">
        {{ $posts->links() }}
    </div>
</div>
@endsection
