@extends('layouts.admin')

@section('title', 'Pengaturan Web')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="{ logoType: '{{ old('logo_type', $settings['logo_type'] ?? 'text') }}' }">
        @csrf
        @method('PATCH')

        <!-- Branding Section -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <h3 class="text-xl font-black italic mb-6 tracking-tight">Identitas & Branding</h3>
            
            <div class="space-y-8">
                <!-- Logo Type Selection -->
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Tipe Logo</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="logo_type" value="text" x-model="logoType" class="hidden peer">
                            <div class="text-center py-4 rounded-2xl border-2 border-gray-100 dark:border-gray-800 peer-checked:border-purple-600 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 transition-all">
                                <span class="material-icons mb-1 block">title</span>
                                <span class="text-xs font-bold uppercase tracking-widest">Teks</span>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="logo_type" value="image" x-model="logoType" class="hidden peer">
                            <div class="text-center py-4 rounded-2xl border-2 border-gray-100 dark:border-gray-800 peer-checked:border-purple-600 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 transition-all">
                                <span class="material-icons mb-1 block">image</span>
                                <span class="text-xs font-bold uppercase tracking-widest">Gambar</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Text Logo Input -->
                <div x-show="logoType === 'text'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Logo Situs (Teks)</label>
                    <input type="text" name="site_logo" value="{{ old('site_logo', $settings['site_logo'] ?? '') }}" 
                           class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all"
                           placeholder="Misal: WP atau MyPortal">
                    @error('site_logo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Image Logo Input -->
                <div x-show="logoType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Logo Situs (Gambar)</label>
                    
                    <div class="flex items-center gap-6">
                        @if(isset($settings['site_logo_image']) && $settings['site_logo_image'])
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 flex-shrink-0">
                                <img src="{{ asset('storage/' . $settings['site_logo_image']) }}" class="w-full h-full object-contain">
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 dark:border-gray-800 border-dashed rounded-2xl relative group hover:border-purple-300 transition-colors">
                                <div class="space-y-1 text-center">
                                    <span class="material-icons text-gray-300 text-4xl mb-2">cloud_upload</span>
                                    <div class="flex text-sm text-gray-600">
                                        <label class="relative cursor-pointer font-bold text-purple-600 hover:text-purple-500">
                                            <span>Pilih File</span>
                                            <input name="site_logo_image" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-[10px] text-gray-400 italic">PNG maksimal 2MB</p>
                                </div>
                            </div>
                            @error('site_logo_image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Judul Selamat Datang</label>
                        <input type="text" name="welcome_title" value="{{ old('welcome_title', $settings['welcome_title'] ?? '') }}" required 
                               class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Deskripsi Selamat Datang</label>
                        <textarea name="welcome_description" rows="1" required 
                                  class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all">{{ old('welcome_description', $settings['welcome_description'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-icons text-purple-600">public</span>
                <h3 class="text-xl font-black italic tracking-tight">Media Sosial</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Instagram</label>
                    <input type="text" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" 
                           class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-pink-500 transition-all" placeholder="URL Profil">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Facebook</label>
                    <input type="text" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" 
                           class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-600 transition-all" placeholder="URL Profil">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">TikTok</label>
                    <input type="text" name="social_tiktok" value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}" 
                           class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-black transition-all" placeholder="URL Profil">
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-icons text-purple-600">copyright</span>
                <h3 class="text-xl font-black italic tracking-tight">Footer</h3>
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Teks Footer</label>
                <input type="text" name="footer_text" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" required 
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-teal-600 transition-all">
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-black dark:bg-white text-white dark:text-black px-12 py-4 rounded-2xl font-black text-sm hover:scale-105 transition-all shadow-xl shadow-black/10 dark:shadow-white/10">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
