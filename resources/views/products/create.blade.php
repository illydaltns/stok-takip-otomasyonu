@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-dark-bg-secondary rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">

    <!-- Başlık Kutusu -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-dark-text-primary">Yeni Ürün Ekle</h1>
            <p class="text-sm text-gray-500 dark:text-dark-text-secondary">Yeni bir ürün oluşturun. Ürün adı, kategori, stok ve diğer bilgileri girin.</p>
        </div>
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Geri Dön
        </a>
    </div>

    <!-- Form Alanı -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-4 space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Ürün Adı</label>
            <input type="text" name="name" id="name"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                   required>
            @error('name')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Kategori</label>
            <select name="category_id" id="category_id"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                    required>
                <option value="">Kategori seçin</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Stok Miktarı</label>
            <input type="number" name="stock_quantity" id="stock_quantity"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                   min="0" required>
            @error('stock_quantity')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock_alert_level" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Stok Uyarı Seviyesi</label>
            <input type="number" name="stock_alert_level" id="stock_alert_level"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                   min="0" required>
            @error('stock_alert_level')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Fiyat (₺)</label>
            <input type="number" step="0.01" name="price" id="price"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"
                   required>
            @error('price')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Açıklama</label>
            <textarea name="description" id="description" rows="3"
                      class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary"></textarea>
            @error('description')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image_path" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary">Ürün Görseli</label>
            <input type="file" name="image_path" id="image_path"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-800 dark:text-dark-text-primary placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 bg-white dark:bg-dark-bg-primary">
            @error('image_path')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Butonlar -->
        <div class="flex justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-4">
            <a href="{{ route('products.index') }}"
               class="px-5 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-secondary bg-white dark:bg-dark-bg-primary hover:bg-gray-100 dark:hover:bg-dark-bg-secondary rounded text-sm">
                İptal
            </a>
            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded text-sm">
                Ürün Ekle
            </button>
        </div>
    </form>
</div>
@endsection
