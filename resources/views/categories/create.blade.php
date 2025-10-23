@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-dark-bg-secondary rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">

    <!-- Başlık -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-dark-text-primary">Yeni Kategori Ekle</h1>
            <p class="text-sm text-gray-500 dark:text-dark-text-secondary">Yeni bir kategori oluşturun.</p>
        </div>
        <a href="{{ route('categories.index') }}"
        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Geri Dön
        </a>
    </div>


    <!-- Form -->
    <form action="{{ route('categories.store') }}" method="POST" class="px-6 py-6 space-y-5">
        @csrf

        <!-- Kategori Adı -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Kategori Adı</label>
            <input type="text" name="name" id="name"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                   required>
            @error('name')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Açıklama -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Açıklama</label>
            <textarea name="description" id="description" rows="3"
                      class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"></textarea>
            @error('description')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Butonlar -->
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('categories.index') }}"
                       class="px-5 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-secondary bg-white dark:bg-dark-bg-primary hover:bg-gray-100 dark:hover:bg-dark-bg-secondary rounded text-sm">
                İptal
            </a>
            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded text-sm">
                Kategori Ekle
            </button>
        </div>
    </form>
        </div>
    </main>
</div>
@endsection
