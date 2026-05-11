<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-black italic tracking-tight text-red-600">
            Hapus Akun
        </h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-red-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-500/20">
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black italic tracking-tight text-gray-900 dark:text-gray-100">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Kata Sandi</label>
                <input id="password" name="password" type="password" placeholder="Masukkan Kata Sandi Anda"
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-red-600 transition-all">
                @error('password', 'userDeletion') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-500/20">
                    Hapus Selamanya
                </button>
            </div>
        </form>
    </x-modal>
</section>
