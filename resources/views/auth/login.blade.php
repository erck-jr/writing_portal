<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10">
        <h2 class="text-3xl font-black italic tracking-tight mb-2">Selamat Datang</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-6">
            <div>
                <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                       class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-purple-600 transition-all"
                       placeholder="nama@email.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-gray-400">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="text-[10px] font-bold text-purple-600 hover:underline uppercase tracking-widest" href="{{ route('password.request') }}">
                            Lupa?
                        </a>
                    @endif
                </div>
                <div class="relative" x-data="{ show: false }">
                    <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                           class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 pr-12 text-sm focus:ring-2 focus:ring-purple-600 transition-all"
                           placeholder="••••••••">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600 transition-colors">
                        <span class="material-icons text-sm" x-show="!show">visibility</span>
                        <span class="material-icons text-sm" x-show="show">visibility_off</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Remember Me -->
        <div class="mt-6 flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 dark:bg-gray-800 dark:border-gray-700" name="remember">
                <span class="ms-2 text-xs font-medium text-gray-600 dark:text-gray-400">Ingat saya</span>
            </label>
        </div>

        <div class="mt-10">
            <button type="submit" class="w-full bg-black dark:bg-white text-white dark:text-black font-black py-4 rounded-2xl hover:scale-[1.02] transition-transform shadow-xl shadow-black/10 dark:shadow-white/5">
                Masuk Sekarang
            </button>
        </div>

        @if (Route::has('register'))
            <p class="mt-8 text-center text-xs text-gray-500 dark:text-gray-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-purple-600 hover:underline">Daftar di sini</a>
            </p>
        @endif
    </form>
</x-guest-layout>
