@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Başlık -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-dark-text-primary">Satış Performans Ekranı</h1>
        <p class="text-gray-600 dark:text-dark-text-secondary">Genel satış istatistikleri ve ekip performansı</p>
    </div>

    <!-- İstatistik Kartları -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Toplam Satış -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/50 dark:to-blue-800/50 p-6 rounded-2xl shadow-sm border border-blue-100 dark:border-blue-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-blue-800 dark:text-blue-300">Toplam Satış</h2>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalSales }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-800/50 p-3 rounded-full">
                    <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-blue-500 dark:text-blue-400 mt-3">+5.2% geçen aya göre</p>
        </div>

        <!-- Toplam Ciro -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/50 dark:to-green-800/50 p-6 rounded-2xl shadow-sm border border-green-100 dark:border-green-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-green-800 dark:text-green-300">Toplam Ciro</h2>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">₺{{ number_format($totalRevenue, 2, ',', '.') }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-800/50 p-3 rounded-full">
                    <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-green-500 dark:text-green-400 mt-3">+12.7% geçen aya göre</p>
        </div>

        <!-- En Çok Satılan Ürün -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/50 dark:to-purple-800/50 p-6 rounded-2xl shadow-sm border border-purple-100 dark:border-purple-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-purple-800 dark:text-purple-300">En Çok Satılan Ürün</h2>
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400 mt-2 truncate">
                        {{ $topProducts->first()?->product?->name ?? '-' }}
                    </p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-800/50 p-3 rounded-full">
                    <svg class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-purple-500 dark:text-purple-400 mt-3">
                {{ $topProducts->first()?->total_sold ?? 0 }} adet satış
            </p>
        </div>

        <!-- En İyi Kasiyer -->
        <div class="bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/50 dark:to-amber-800/50 p-6 rounded-2xl shadow-sm border border-amber-100 dark:border-amber-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-amber-800 dark:text-amber-300">En İyi Kasiyer</h2>
                    <p class="text-xl font-bold text-amber-600 dark:text-amber-400 mt-2 truncate">
                        {{ $topCashier?->user?->name ?? '-' }}
                    </p>
                </div>
                <div class="bg-amber-100 dark:bg-amber-800/50 p-3 rounded-full">
                    <svg class="h-8 w-8 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-amber-500 dark:text-amber-400 mt-3">
                {{ $topCashier?->total_sales ?? 0 }} satış
            </p>
        </div>
    </div>

    <!-- Kullanıcı Satış Performansı Tablosu -->
    <div class="bg-white dark:bg-dark-bg-secondary p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-dark-text-primary">Kullanıcı Satış Performansı</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 dark:text-dark-text-secondary border-b dark:border-gray-700">
                        <th class="pb-3 font-medium">#</th>
                        <th class="pb-3 font-medium">Kasiyer</th>
                        <th class="pb-3 font-medium">E-posta</th>
                        <th class="pb-3 font-medium text-right">Satış Sayısı</th>
                        <th class="pb-3 font-medium text-right">Ciro</th>
                        <th class="pb-3 font-medium text-right">Performans</th>
                        <th class="pb-3 font-medium text-right">İncele</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($users as $index => $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="py-4 dark:text-dark-text-primary">{{ $index + 1 }}</td>
                        <td class="py-4">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-8 h-8 rounded-full object-cover mr-3">
                                <span class="dark:text-dark-text-primary">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 text-gray-600 dark:text-dark-text-secondary">{{ $user->email }}</td>
                        <td class="py-4 text-right font-medium dark:text-dark-text-primary">{{ $user->sales_count }}</td>
                        <td class="py-4 text-right dark:text-dark-text-primary">
                            ₺{{ number_format($user->sales_sum_total ?? 0, 2, ',', '.') }}
                        </td>
                        <td class="py-4 text-right">
                            @php
                                $performance = min(100, max(0, ($user->sales_count / ($users->max('sales_count') ?: 1)) * 100));
                            @endphp
                            <div class="flex items-center justify-end">
                                <div class="w-20 bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-2">
                                    <div class="bg-blue-600 dark:bg-blue-500 h-2 rounded-full" style="width: {{ $performance }}%"></div>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-dark-text-secondary">{{ round($performance) }}%</span>
                            </div>
                        </td>
                        <td class="py-4 text-right">
                            <a href="{{ route('statistics.user.details', $user->id) }}" 
                               class="text-gray-600 dark:text-dark-text-secondary hover:text-gray-900 dark:hover:text-dark-text-primary" title="Detayları İncele">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" stroke-linecap="round" stroke-linejoin="round" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@endsection