@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 p-4 md:p-6">

    <!-- Profil Bilgileri -->
    <div class="bg-white dark:bg-dark-bg-primary p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-dark-text-primary">Profile Information</h2>
            <div class="relative">
    @if(auth()->user()->profile_photo_path)
        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
             class="w-16 h-16 rounded-full object-cover border-2 border-blue-200 dark:border-blue-700">
    @else
        <div class="w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-2xl font-bold">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    @endif

    <!-- Form buraya geliyor ve input içinde -->
    <form id="photo-form" method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        
        <label for="photo" class="absolute bottom-0 right-0 bg-white dark:bg-dark-bg-primary p-1 rounded-full shadow cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </label>
        <input id="photo" name="photo" type="file" class="hidden"
               onchange="document.getElementById('photo-form').submit()">
    </form>
</div>

        </div>

        <form id="photo-form" method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data" class="hidden">
    @csrf
    @method('PATCH')

    <input id="photo" name="photo" type="file" class="hidden" onchange="document.getElementById('photo-form').submit()">
</form>


        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 focus:border-blue-500 dark:focus:border-blue-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 focus:border-blue-500 dark:focus:border-blue-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Şifre Güncelle -->
    <div class="bg-white dark:bg-dark-bg-primary p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
        <h2 class="text-xl font-bold text-gray-800 dark:text-dark-text-primary mb-6">Update Password</h2>
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 focus:border-blue-500 dark:focus:border-blue-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 focus:border-blue-500 dark:focus:border-blue-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 focus:border-blue-500 dark:focus:border-blue-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary">
                </div>
            </div>
            @error('password')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            <div class="pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Hesap Silme -->
    <div class="bg-white dark:bg-dark-bg-primary p-6 rounded-xl shadow-md border border-red-100 dark:border-red-900">
        <h2 class="text-xl font-bold text-red-600 dark:text-red-400 mb-3">Delete Account</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-5">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-red-200 dark:focus:ring-red-700 focus:border-red-500 dark:focus:border-red-400 transition bg-white dark:bg-dark-bg-primary text-gray-900 dark:text-dark-text-primary"
                       placeholder="Enter your password to confirm" required>
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                Delete Account
            </button>
        </form>
    </div>

</div>
@endsection