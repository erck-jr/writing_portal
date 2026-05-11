<footer class="bg-white dark:bg-black border-t border-gray-100 dark:border-gray-800 py-12 mt-20">
    <x-container>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                    <span class="text-3xl font-black tracking-tighter text-black dark:text-white">
                        {{ $site_settings['site_logo'] ?? 'WP' }}
                    </span>
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xs leading-relaxed">
                    {{ $site_settings['welcome_description'] ?? 'A minimalist writing portal for thinkers, creators, and storytellers.' }}
                </p>
            </div>
            
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-100 mb-6 italic">Kategori</h4>
                <ul class="space-y-4">
                    @foreach(\App\Models\Category::take(5)->get() as $category)
                        <li><a href="{{ route('categories.show', $category->slug) }}" class="text-sm text-gray-500 hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400 transition-colors">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-100 mb-6 italic">Media Sosial</h4>
                <ul class="space-y-4">
                    @if($site_settings['social_instagram'] ?? false)
                        <li><a href="{{ $site_settings['social_instagram'] }}" class="text-sm text-gray-500 hover:text-teal-600 dark:text-gray-400 dark:hover:text-teal-400 transition-colors">Instagram</a></li>
                    @endif
                    @if($site_settings['social_facebook'] ?? false)
                        <li><a href="{{ $site_settings['social_facebook'] }}" class="text-sm text-gray-500 hover:text-teal-600 dark:text-gray-400 dark:hover:text-teal-400 transition-colors">Facebook</a></li>
                    @endif
                    @if($site_settings['social_tiktok'] ?? false)
                        <li><a href="{{ $site_settings['social_tiktok'] }}" class="text-sm text-gray-500 hover:text-teal-600 dark:text-gray-400 dark:hover:text-teal-400 transition-colors">TikTok</a></li>
                    @endif
                </ul>
            </div>
        </div>
        
        <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                {{ $site_settings['footer_text'] ?? '© ' . date('Y') . ' Writing Portal.' }}
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </x-container>
</footer>