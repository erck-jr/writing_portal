@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <p class="text-sm text-gray-500 font-medium">Atur artikel Anda dengan mengelompokkannya ke dalam kategori.</p>
    </div>
    <button onclick="openModal('create')" class="bg-purple-600 text-white px-6 py-3 rounded-2xl font-bold text-sm flex items-center gap-2 hover:bg-purple-700 transition-colors shadow-lg shadow-purple-500/20">
        <span class="material-icons text-sm">add</span> Tambah Kategori
    </button>
</div>

<!-- Search & Filters -->
<div class="mb-6 flex flex-col md:flex-row gap-4">
    <form action="{{ route('admin.categories.index') }}" method="GET" class="flex-1 flex gap-2">
        <div class="relative flex-1 group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <span class="material-icons text-gray-400 group-focus-within:text-purple-600 transition-colors text-base">search</span>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl py-3.5 pl-14 pr-4 text-sm focus:ring-4 focus:ring-purple-600/10 focus:border-purple-600 transition-all shadow-sm" 
                   placeholder="Cari nama kategori...">
        </div>
        <button type="submit" class="bg-black dark:bg-white text-white dark:text-black px-6 rounded-2xl font-bold text-xs uppercase tracking-widest hover:scale-105 transition-all">
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-100 dark:bg-gray-800 text-gray-500 px-6 rounded-2xl font-bold text-xs uppercase tracking-widest flex items-center hover:bg-gray-200 transition-all">
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
                    <th class="px-8 py-4">ID</th>
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Slug</th>
                    <th class="px-8 py-4">Jumlah Artikel</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-gray-400">#{{ $category->id }}</td>
                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $category->name }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <x-badge variant="gray">{{ $category->slug }}</x-badge>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold">{{ $category->posts_count ?? $category->posts()->count() }}</span>
                            <span class="text-xs text-gray-400">artikel</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openModal('edit', {{ $category }})" class="p-2 text-gray-400 hover:text-teal-500 transition-colors">
                                <span class="material-icons">edit</span>
                            </button>
                            <button onclick="confirmDelete({{ $category->id }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                <span class="material-icons">delete</span>
                            </button>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-gray-500 italic">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-gray-100 dark:border-gray-800">
        {{ $categories->links() }}
    </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl z-50 w-full max-w-md overflow-hidden relative border border-gray-100 dark:border-gray-800">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 id="modalTitle" class="text-2xl font-black italic tracking-tight">Tambah Kategori</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    
                    <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div id="methodField"></div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nama Kategori</label>
                                <input type="text" name="name" id="categoryName" required class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all" placeholder="misal: Teknologi">
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-purple-600 text-white font-bold py-4 rounded-2xl hover:bg-purple-700 transition-colors shadow-lg shadow-purple-500/20">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal(type, data = null) {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('modalTitle');
        const nameInput = document.getElementById('categoryName');
        const methodField = document.getElementById('methodField');
        
        if (type === 'create') {
            title.innerText = 'Tambah Kategori Baru';
            form.action = "{{ route('admin.categories.store') }}";
            methodField.innerHTML = '';
            nameInput.value = '';
        } else {
            title.innerText = 'Edit Kategori';
            form.action = `/admin/categories/${data.id}`;
            methodField.innerHTML = '<input type="hidden" name="_method" value="PATCH">';
            nameInput.value = data.name;
        }
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeModal() {
        document.getElementById('categoryModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endpush
@endsection

