<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black italic tracking-tight text-gray-900 dark:text-gray-100">
            Informasi Profil
        </h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
            @error('name') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Alamat Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all">
            @error('email') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/10 rounded-2xl border border-yellow-100 dark:border-yellow-900/20">
                    <p class="text-xs text-yellow-700 dark:text-yellow-500 font-bold">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" class="ml-2 underline hover:text-yellow-800 transition-colors">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs text-green-600 font-bold">
                            Link verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-purple-700 transition-all shadow-lg shadow-purple-500/20">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-xs font-bold text-teal-500">
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
