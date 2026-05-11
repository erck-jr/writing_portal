@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Stat Card -->
    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-2xl flex items-center justify-center">
                <span class="material-icons">article</span>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Artikel</span>
        </div>
        <div class="flex items-end justify-between">
            <h2 class="text-4xl font-black">{{ $stats['posts_count'] }}</h2>
            <span class="text-xs text-teal-500 font-bold flex items-center gap-1">
                <span class="material-icons text-sm">trending_up</span> +5%
            </span>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/30 text-teal-600 rounded-2xl flex items-center justify-center">
                <span class="material-icons">category</span>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</span>
        </div>
        <div class="flex items-end justify-between">
            <h2 class="text-4xl font-black">{{ $stats['categories_count'] }}</h2>
            <span class="text-xs text-purple-500 font-bold">Aktif</span>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl flex items-center justify-center">
                <span class="material-icons">tag</span>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Tag</span>
        </div>
        <div class="flex items-end justify-between">
            <h2 class="text-4xl font-black">{{ $stats['tags_count'] }}</h2>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 text-pink-600 rounded-2xl flex items-center justify-center">
                <span class="material-icons">visibility</span>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Kunjungan</span>
        </div>
        <div class="flex items-end justify-between">
            <h2 class="text-4xl font-black">{{ $stats['total_views'] }}</h2>
            <span class="text-xs text-teal-500 font-bold flex items-center gap-1">
                <span class="material-icons text-sm">visibility</span> Langsung
            </span>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Posts Table -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
            <h3 class="font-bold">Artikel Terbaru</h3>
            <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-purple-600 hover:underline uppercase tracking-widest">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-800/50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($recent_posts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold truncate block max-w-xs">{{ $post->title }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <x-badge variant="turquoise">{{ $post->category->name }}</x-badge>
                        </td>
                        <td class="px-6 py-4">
                            <x-badge :variant="$post->status === 'published' ? 'purple' : 'gray'">{{ $post->status === 'published' ? 'Terbit' : 'Draft' }}</x-badge>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">
                            {{ $post->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-6">
        <div class="bg-purple-600 rounded-3xl p-6 text-white shadow-xl shadow-purple-500/20 relative overflow-hidden">
            <span class="material-icons absolute -right-4 -bottom-4 text-9xl opacity-20 rotate-12">edit_note</span>
            <h3 class="text-xl font-black mb-2 italic">Siap menulis?</h3>
            <p class="text-sm text-purple-100 mb-6">Buat artikel baru dan bagikan pemikiranmu dengan dunia.</p>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 bg-white text-purple-600 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-teal-50 transition-colors">
                <span class="material-icons text-sm">add</span> Artikel Baru
            </a>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm">
            <h3 class="font-bold mb-4">Tautan Cepat</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.categories.index') }}" class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl flex flex-col items-center gap-2 hover:bg-teal-50 dark:hover:bg-teal-900/20 group transition-colors">
                    <span class="material-icons text-gray-400 group-hover:text-teal-500">category</span>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Kategori</span>
                </a>
                <a href="{{ route('admin.tags.index') }}" class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl flex flex-col items-center gap-2 hover:bg-purple-50 dark:hover:bg-purple-900/20 group transition-colors">
                    <span class="material-icons text-gray-400 group-hover:text-purple-500">tag</span>
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400">Tag</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
