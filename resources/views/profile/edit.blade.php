@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="{{ auth()->user()->role === 'admin' ? 'max-w-4xl' : 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8' }} py-8">
    <div class="mb-12">
        <h1 class="text-4xl font-black italic tracking-tighter">Pengaturan Profil</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">Kelola informasi akun dan pengaturan keamanan Anda.</p>
    </div>

    <div class="space-y-12">
        <!-- Profile Info -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <span class="material-icons text-9xl">badge</span>
            </div>
            <div class="max-w-xl relative">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password -->
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <span class="material-icons text-9xl">lock</span>
            </div>
            <div class="max-w-xl relative">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-red-50/50 dark:bg-red-900/10 p-8 rounded-[2.5rem] border border-red-100 dark:border-red-900/20 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <span class="material-icons text-9xl text-red-600">heart_broken</span>
            </div>
            <div class="max-w-xl relative">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
