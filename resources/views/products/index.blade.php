@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-dark-bg-secondary rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Başlık Kutusu -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-dark-text-primary">Ürünler</h1>
            <p class="text-sm text-gray-500 dark:text-dark-text-secondary">Tüm ürünlerinizi yönetin ve düzenleyin.</p>
        </div>

        @can('manage-users')
            <a href="{{ route('products.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                + Yeni Ürün
            </a>
        @endcan
    </div>

    <!-- Filtre Formu -->
    <form method="GET" class="px-6 py-4 flex flex-col sm:flex-row gap-4 border-b border-gray-200 dark:border-gray-700">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Ürün ara..." 
            class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-primary rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800"
        />

        <select name="category" class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-primary rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800">
            <option value="">Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-primary hover:bg-gray-100 dark:hover:bg-dark-bg-secondary rounded text-sm">
            Filtrele
        </button>
    </form>

    <!-- Ürün Tablosu -->
    <div class="px-6 py-4 overflow-x-auto">
        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full text-sm border-t border-gray-200 dark:border-gray-700">
            <thead class="bg-gray-100 dark:bg-dark-bg-primary text-gray-600 dark:text-dark-text-secondary uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Görsel</th>
                    <th class="px-6 py-3 text-left">Ürün Adı</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Açıklama</th>
                    <th class="px-6 py-3 text-left">Fiyat</th>
                    <th class="px-6 py-3 text-left">Stok</th>
                    <th class="px-6 py-3 text-left">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-dark-bg-primary/50">
                        <td class="px-6 py-4">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="h-10 w-10 object-cover rounded" alt="{{ $product->name }}">
                            @else
                                <div class="h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-gray-500 dark:text-gray-400">?</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800 dark:text-dark-text-primary">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-dark-text-secondary">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-dark-text-secondary">{{ $product->description ?? '-' }}</td>
                        <td class="px-6 py-4 text-green-600 dark:text-green-400">₺{{ $product->price }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-dark-text-secondary">
                            {{ $product->stock_quantity }} adet
                            @if ($product->stock_quantity <= $product->stock_alert_level)
                                <span class="ml-2 text-red-600 dark:text-red-400 font-semibold">!</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            @can('manage-users')
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">Düzenle</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Sil</button>
                                </form>
                            @else
                                <span class="text-gray-500 dark:text-gray-400 text-sm">Yetkiniz Yok</span>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Sayfalama Linkleri --}}
    @if ($products->hasPages())
        <div class="p-6">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection
