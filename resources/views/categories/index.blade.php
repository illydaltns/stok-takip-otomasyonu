@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-dark-bg-secondary rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Başlık Kutusu -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-dark-text-primary">Kategoriler</h1>
            <p class="text-sm text-gray-500 dark:text-dark-text-secondary">Tüm kategorilerinizi yönetin ve düzenleyin.</p>
        </div>
        @can('manage-users')
            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Yeni Kategori
            </a>
        @endcan
    </div>

    <!-- İçerik -->
    <div class="px-6 py-4">
        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border-t border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-dark-bg-primary text-gray-600 dark:text-dark-text-secondary uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Ad</th>
                        <th class="px-6 py-3 text-left">Açıklama</th>
                        <th class="px-6 py-3 text-left">Ürün Sayısı</th>
                        <th class="px-6 py-3 text-left">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-dark-bg-primary/50">
                            <td class="px-6 py-4 text-gray-600 dark:text-dark-text-secondary">{{ $category->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-dark-text-primary">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-500 dark:text-dark-text-secondary">{{ $category->description }}</td>
                            <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium">{{ $category->products_count }}</td>
                            <td class="px-6 py-4 space-x-2">
                                @can('manage-users')
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="text-blue-600 dark:text-blue-400 hover:underline hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                                        Düzenle
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:underline hover:text-red-800 dark:hover:text-red-300 text-sm font-medium">
                                            Sil
                                        </button>
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
    </div>
</div>
@endsection
