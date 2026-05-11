@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
<div class="max-w-full mx-auto">
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Editor -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}" required 
                                   class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-lg font-bold focus:ring-2 focus:ring-purple-600 transition-all" 
                                   placeholder="Masukkan judul yang menarik...">
                            @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Konten</label>
                            <textarea id="editor" name="content" required 
                                      class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all font-mono" 
                                      placeholder="Mulai tulis ceritamu di sini...">{{ old('content', $post->content) }}</textarea>
                            @error('content') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Options -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <h3 class="font-bold mb-6 italic tracking-tight">Pengaturan Artikel</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Kategori</label>
                            <select name="category_id" required class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-teal-500 transition-all">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Status & Utama</label>
                            <div class="flex gap-2">
                                <label class="flex-1 cursor-pointer group">
                                    <input type="radio" name="status" value="draft" class="hidden peer" {{ old('status', $post->status) === 'draft' ? 'checked' : '' }}>
                                    <div class="text-center py-2 rounded-xl bg-gray-50 dark:bg-gray-800 text-xs font-bold text-gray-400 peer-checked:bg-gray-100 peer-checked:text-gray-700 dark:peer-checked:bg-gray-700 dark:peer-checked:text-gray-200 border-2 border-transparent peer-checked:border-gray-200 transition-all">
                                        Draft
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer group">
                                    <input type="radio" name="status" value="published" class="hidden peer" {{ old('status', $post->status) === 'published' ? 'checked' : '' }}>
                                    <div class="text-center py-2 rounded-xl bg-gray-50 dark:bg-gray-800 text-xs font-bold text-gray-400 peer-checked:bg-purple-100 peer-checked:text-purple-700 dark:peer-checked:bg-purple-900/30 dark:peer-checked:text-purple-400 border-2 border-transparent peer-checked:border-purple-200 transition-all">
                                        Terbit
                                    </div>
                                </label>
                            </div>
                            <div class="mt-3">
                                <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 dark:bg-gray-800 rounded-xl hover:bg-yellow-50 dark:hover:bg-yellow-900/10 transition-colors border-2 border-transparent peer-checked:border-yellow-200">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                    <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Jadikan Artikel Utama</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Gambar Sampul</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 dark:border-gray-800 border-dashed rounded-2xl relative group hover:border-purple-300 transition-colors">
                                <div class="space-y-1 text-center">
                                    <span class="material-icons text-gray-300 text-4xl mb-2">image</span>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="cover_image" class="relative cursor-pointer font-bold text-purple-600 hover:text-purple-500">
                                            <span>Unggah file</span>
                                            <input id="cover_image" name="cover_image" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-[10px] text-gray-400 italic">PNG, JPG maksimal 2MB</p>
                                </div>
                                @if($post->cover_image)
                                    <img src="{{ asset('storage/'.$post->cover_image) }}" class="absolute inset-0 w-full h-full object-cover rounded-2xl opacity-40 group-hover:opacity-20 transition-opacity">
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Tag</label>
                            <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto p-2 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                @foreach($tags as $tag)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                               {{ (collect(old('tags'))->contains($tag->id) || $post->tags->contains($tag->id)) ? 'checked' : '' }}>
                                        <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-purple-600 text-white font-black py-4 rounded-2xl hover:bg-purple-700 transition-all shadow-xl shadow-purple-500/30 flex items-center justify-center gap-2">
                            <span class="material-icons">save</span>
                            Perbarui Artikel
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="block text-center mt-4 text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.9/jodit.min.css"/>
<style>
    .jodit-container { border-radius: 1.5rem !important; border: none !important; overflow: hidden; }
    .jodit-wysiwyg { background: #f9fafb !important; }
    .dark .jodit-wysiwyg { background: #1f2937 !important; color: white !important; }
    .dark .jodit-toolbar__box { background: #111827 !important; border-bottom: 1px solid #374151 !important; }
    .dark .jodit-toolbar-button__button { color: #9ca3af !important; }
</style>
@endpush

@push('scripts')
<script>
    function initJodit() {
        if (typeof Jodit !== 'undefined') {
            Jodit.make('#editor', {
                height: 400,
                theme: document.documentElement.classList.contains('dark') ? 'dark' : 'default',
                toolbarAdaptive: false,
                buttons: 'bold,italic,underline,strikethrough,eraser,ul,ol,font,fontsize,paragraph,lineHeight,superscript,subscript,classSpan,file,image,video,spellcheck,cut,copy,paste,selectall,copyformat,hr,table,link,symbols,indent,outdent,left,center,right,justify,undo,redo,find,source,fullsize,preview,print'
            });
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.9/jodit.min.js" onload="initJodit()"></script>
@endpush
