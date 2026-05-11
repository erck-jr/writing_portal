<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black italic tracking-tight text-gray-900 dark:text-gray-100">
            Perbarui Kata Sandi
        </h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <label for="update_password_current_password" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Kata Sandi Saat Ini</label>
            <div class="relative">
                <input id="update_password_current_password" name="current_password" :type="show ? 'text' : 'password'" autocomplete="current-password"
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 pr-12 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600 transition-colors">
                    <span class="material-icons text-sm" x-show="!show">visibility</span>
                    <span class="material-icons text-sm" x-show="show">visibility_off</span>
                </button>
            </div>
            @error('current_password', 'updatePassword') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="update_password_password" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Kata Sandi Baru</label>
            <div class="relative">
                <input id="update_password_password" name="password" :type="show ? 'text' : 'password'" autocomplete="new-password"
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 pr-12 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600 transition-colors">
                    <span class="material-icons text-sm" x-show="!show">visibility</span>
                    <span class="material-icons text-sm" x-show="show">visibility_off</span>
                </button>
            </div>
            @error('password', 'updatePassword') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="update_password_password_confirmation" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Konfirmasi Kata Sandi Baru</label>
            <div class="relative">
                <input id="update_password_password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" autocomplete="new-password"
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 pr-12 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600 transition-colors">
                    <span class="material-icons text-sm" x-show="!show">visibility</span>
                    <span class="material-icons text-sm" x-show="show">visibility_off</span>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black dark:bg-white text-white dark:text-black px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-all shadow-lg shadow-black/10 dark:shadow-white/10">
                Simpan Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-xs font-bold text-teal-500">
                    Sandi berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
