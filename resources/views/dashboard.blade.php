<x-layout>
    <x-slot:title>Dashboard - Stockify</x-slot:title>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-600">Ringkasan informasi stok dan aktivitas gudang</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- Total Produk -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Produk</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($statistics['total_products']) }}</div>
                                        <div class="ml-2 text-sm text-green-600">{{ $statistics['active_products'] }} aktif</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang Masuk Hari Ini -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Barang Masuk</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($statistics['transactions_in_today']) }}</div>
                                        <div class="ml-2 text-sm text-gray-500">hari ini</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang Keluar Hari Ini -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Barang Keluar</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($statistics['transactions_out_today']) }}</div>
                                        <div class="ml-2 text-sm text-gray-500">hari ini</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok Menipis -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Stok Menipis</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($statistics['low_stock_products']) }}</div>
                                        <div class="ml-2 text-sm text-yellow-600">produk</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mb-6">
                <!-- Stock Transactions Chart (Last 7 Days) -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Transaksi Stok (7 Hari Terakhir)</h3>
                    <canvas id="stockChart" class="w-full" height="300"></canvas>
                </div>

                <!-- Monthly Transactions Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Transaksi Bulanan (6 Bulan Terakhir)</h3>
                    <canvas id="monthlyChart" class="w-full" height="300"></canvas>
                </div>
            </div>

            <!-- Content Row -->
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3 mb-6">
                <!-- Low Stock Products -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Stok Menipis</h3>
                    </div>
                    <div class="p-6">
                        <div class="flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse($lowStockProducts as $product)
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                {{ $product->stock }} {{ $product->unit }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="py-4 text-center text-gray-500">Tidak ada produk dengan stok menipis</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Transaksi Terbaru</h3>
                    </div>
                    <div class="p-6">
                        <div class="flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse($recentTransactions as $transaction)
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            @if($transaction->type === 'in')
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </span>
                                            @else
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-red-100">
                                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $transaction->product->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $transaction->quantity }} {{ $transaction->product->unit }}</p>
                                        </div>
                                        <div class="flex-shrink-0 text-sm text-gray-500">
                                            {{ $transaction->transaction_date->format('H:i') }}
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="py-4 text-center text-gray-500">Belum ada transaksi</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Aktivitas Pengguna</h3>
                    </div>
                    <div class="p-6">
                        <div class="flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse($recentActivities as $activity)
                                <li class="py-4">
                                    <div class="flex space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-600">{{ substr($activity['user'], 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-900">
                                                <span class="font-medium">{{ $activity['user'] }}</span>
                                                <span class="text-gray-500"> {{ $activity['action'] }}</span>
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">{{ $activity['product'] }}</p>
                                            <p class="text-xs text-gray-400">{{ $activity['time'] }}</p>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="py-4 text-center text-gray-500">Belum ada aktivitas</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Stock Chart (Last 7 Days)
        const stockCtx = document.getElementById('stockChart').getContext('2d');
        new Chart(stockCtx, {
            type: 'line',
            data: {
                labels: @json($stockChart['labels']),
                datasets: [{
                    label: 'Barang Masuk',
                    data: @json($stockChart['transactions_in']),
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Barang Keluar',
                    data: @json($stockChart['transactions_out']),
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyTransactionSummary['labels']),
                datasets: [{
                    label: 'Barang Masuk',
                    data: @json($monthlyTransactionSummary['transactions_in']),
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                }, {
                    label: 'Barang Keluar',
                    data: @json($monthlyTransactionSummary['transactions_out']),
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>
