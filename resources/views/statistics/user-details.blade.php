@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="mb-8 bg-white dark:bg-[#1f1f1f] rounded-xl shadow-sm border border-gray-200 dark:border-[#333] p-6 flex flex-col items-center">
    <!-- Profil kısmı -->
    <div class="flex flex-col items-center space-y-2 md:flex-row md:space-x-4 md:space-y-0">
      <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('default-avatar.png') }}" 
           class="w-16 h-16 rounded-full object-cover border-2 border-blue-100 dark:border-blue-500" alt="Profil Fotoğrafı">
      <div class="text-center md:text-left">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h1>
        <p class="text-gray-600 dark:text-neutral-400">{{ $user->email }}</p>
      </div>
    </div>

    <!-- Kartlar -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 w-full max-w-3xl">
      <div class="bg-blue-50 dark:bg-[#2a2a2a] p-4 rounded-lg text-center">
        <p class="text-sm text-blue-600 dark:text-blue-300 font-medium">Toplam Satış</p>
        <p class="text-2xl font-bold text-blue-800 dark:text-white">{{ $totalSales }}</p>
        <p class="text-xs text-blue-500 dark:text-blue-400 mt-1">+5.2% geçen aya göre</p>
      </div>

      <div class="bg-green-50 dark:bg-[#2a2a2a] p-4 rounded-lg text-center">
        <p class="text-sm text-green-600 dark:text-green-300 font-medium">Toplam Ciro</p>
        <p class="text-2xl font-bold text-green-800 dark:text-white">₺{{ number_format($totalRevenue, 2, ',', '.') }}</p>
        <p class="text-xs text-green-500 dark:text-green-400 mt-1">+12.7% geçen aya göre</p>
      </div>

      <div class="bg-purple-50 dark:bg-[#2a2a2a] p-4 rounded-lg text-center">
        <p class="text-sm text-purple-600 dark:text-purple-300 font-medium">Ort. Satış Tutarı</p>
        <p class="text-2xl font-bold text-purple-800 dark:text-white">
          ₺{{ $totalSales > 0 ? number_format($totalRevenue / $totalSales, 2, ',', '.') : '0,00' }}
        </p>
        <p class="text-xs text-purple-500 dark:text-purple-400 mt-1">+3.1% geçen aya göre</p>
      </div>
    </div>
  </div>

  <!-- Tablo -->
  <div class="bg-white dark:bg-[#1f1f1f] rounded-xl shadow-sm border border-gray-200 dark:border-[#333] overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-[#333]">
      <h2 class="text-lg font-bold text-gray-800 dark:text-white text-center">Satılan Ürünler</h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 dark:text-neutral-300 bg-gray-50 dark:bg-[#181818]">
            <th class="px-6 py-3 font-medium">Ürün</th>
            <th class="px-6 py-3 font-medium">Kategori</th>
            <th class="px-6 py-3 font-medium text-right">Miktar</th>
            <th class="px-6 py-3 font-medium text-right">Birim Fiyat</th>
            <th class="px-6 py-3 font-medium text-right">Toplam Ciro</th>
            <th class="px-6 py-3 font-medium text-right">Satış Oranı</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
          @foreach ($productStats as $stat)
          <tr class="hover:bg-gray-50 dark:hover:bg-[#2d2d2d]">
            <td class="px-6 py-4 text-gray-800 dark:text-neutral-100">
              <div class="flex items-center">
                <div class="h-10 w-10 bg-gray-200 dark:bg-[#2a2a2a] rounded-md overflow-hidden">
                  @if($stat->product->image_path)
                  <img src="{{ asset('storage/' . $stat->product->image_path) }}" class="h-full w-full object-cover" alt="{{ $stat->product->name }}">
                  @else
                  <div class="h-full w-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                  @endif
                </div>
                <div class="ml-4">
                  <div class="font-medium text-gray-900 dark:text-white">{{ $stat->product->name }}</div>
                  <div class="text-gray-500 dark:text-neutral-400 text-xs">{{ $stat->product->sku ?? 'SKU Yok' }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="px-2 py-1 text-xs rounded-full bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200">
                {{ $stat->product->category->name ?? '-' }}
              </span>
            </td>
            <td class="px-6 py-4 text-right font-medium text-gray-800 dark:text-gray-100">{{ $stat->total_quantity }}</td>
            <td class="px-6 py-4 text-right text-green-600 dark:text-green-400">₺{{ number_format($stat->product->price, 2, ',', '.') }}</td>
            <td class="px-6 py-4 text-right font-bold text-green-700 dark:text-green-300">₺{{ number_format($stat->total_earning, 2, ',', '.') }}</td>
            <td class="px-6 py-4 text-right">
              <div class="flex items-center justify-end">
                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-2">
                  @php
                      $totalQuantitySum = $productStats->sum('total_quantity') ?: 1; 
                      $percentage = ($stat->total_quantity / $totalQuantitySum) * 100;
                  @endphp
                  <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
                <span class="text-xs text-gray-500 dark:text-gray-300">{{ round($percentage, 1) }}%</span>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="px-6 py-4 border-t bg-gray-50 dark:bg-[#181818] border-gray-200 dark:border-[#333] text-sm text-gray-500 dark:text-gray-400">
      Toplam {{ $productStats->count() }} ürün listeleniyor
    </div>
  </div>
</div>

   <!-- Grafik Bölümü -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Aylık Satış Grafiği -->
    <div class="bg-white dark:bg-[#1f1f1f] p-6 rounded-xl shadow-sm border dark:border-[#333]">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Aylık Satış Grafiği</h3>
        <div class="h-64 bg-gray-50 dark:bg-[#181818] rounded-lg flex items-center justify-center">
            @if(isset($monthlySales) && count($monthlySales) > 0)
                <canvas id="monthlySalesChart"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
                        const monthlySales = @json($monthlySales);

                        const labels = monthlySales.map(sale => {
                            const monthNames = ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'];
                            return `${monthNames[sale.month - 1]} ${sale.year}`;
                        });

                        const data = monthlySales.map(sale => sale.total);

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Aylık Ciro (₺)',
                                    data: data,
                                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: document.documentElement.classList.contains('dark') ? '#d1d5db' : '#4b5563',
                                            callback: function(value) {
                                                return '₺' + value.toLocaleString();
                                            }
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            color: document.documentElement.classList.contains('dark') ? '#d1d5db' : '#4b5563'
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
            @else
                <p class="text-gray-400 dark:text-gray-400">Satış verisi bulunamadı<br>Ay sonu gösterilecektir!</p>
            @endif
        </div>
    </div>

    <!-- Kategori Dağılımı -->
    <div class="bg-white dark:bg-[#1f1f1f] p-6 rounded-xl shadow-sm border dark:border-[#333]">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Kategori Dağılımı</h3>
        <div class="h-64 bg-gray-50 dark:bg-[#181818] rounded-lg flex items-center justify-center">
            @if(isset($productStats) && count($productStats) > 0)
                <canvas id="categoryChart"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('categoryChart').getContext('2d');
                        const productStats = @json($productStats);

                        const categoryData = {};
                        productStats.forEach(stat => {
                            const categoryName = stat.product.category?.name || 'Diğer';
                            categoryData[categoryName] = (categoryData[categoryName] || 0) + stat.total_earning;
                        });

                        const labels = Object.keys(categoryData);
                        const data = Object.values(categoryData);

                        const backgroundColors = [
                            '#93c5fd',
                            '#6ee7b7',
                            '#fcd34d',
                            '#fca5a5',
                            '#c4b5fd'
                        ];

                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: data,
                                    backgroundColor: backgroundColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const value = context.raw || 0;
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const percentage = Math.round((value / total) * 100);
                                                return `${label}: ₺${value.toLocaleString()} (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
            @else
                <p class="text-gray-400 dark:text-gray-400">Kategori verisi bulunamadı</p>
            @endif
        </div>
    </div>
</div>
@endsection
