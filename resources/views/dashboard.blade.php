
<x-layout title="Dashboard">
<div class="container mx-auto p-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
        <div class="flex items-center space-x-2">
            <label for="period" class="text-sm text-gray-600 dark:text-gray-300">Periode</label>
            <select id="period" class="block w-40 py-1 px-2 bg-white border rounded-md text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option value="7">7 hari</option>
                <option value="30" selected>30 hari</option>
                <option value="90">90 hari</option>
            </select>
        </div>
    </div>

    <!-- Summary cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-white border rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Jumlah Produk</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $productCount ?? 0 }}</p>
                </div>
                <div class="p-2 bg-indigo-100 rounded-full">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Total produk yang terdaftar</p>
        </div>

        <div class="p-4 bg-white border rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Transaksi Masuk</p>
                    <p class="mt-1 text-2xl font-semibold text-green-600 dark:text-green-400">{{ $incomingCount ?? 0 }}</p>
                </div>
                <div class="p-2 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 11a1 1 0 011-1h6V4a1 1 0 112 0v6h6a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Barang masuk pada periode terpilih</p>
        </div>

        <div class="p-4 bg-white border rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Transaksi Keluar</p>
                    <p class="mt-1 text-2xl font-semibold text-red-600 dark:text-red-400">{{ $outgoingCount ?? 0 }}</p>
                </div>
                <div class="p-2 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17 9a1 1 0 00-1-1h-6V2a1 1 0 10-2 0v6H4a1 1 0 100 2h10a1 1 0 001-1z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Barang keluar pada periode terpilih</p>
        </div>

        <div class="p-4 bg-white border rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Stok</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalStock ?? 0 }}</p>
                </div>
                <div class="p-2 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3h12v4H4V3zM3 9h14v8a1 1 0 01-1 1H4a1 1 0 01-1-1V9z"/>
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Jumlah stok semua produk</p>
        </div>
    </div>

    <!-- Main content: chart + recent activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border rounded-lg p-4 shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Grafik Stok Barang</h2>
                <div class="text-sm text-gray-500 dark:text-gray-400">Periode terakhir</div>
            </div>
            <canvas id="stockChart" class="w-full h-64"></canvas>
        </div>

        <div class="bg-white border rounded-lg p-4 shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Aktivitas Terbaru</h2>
                @if(Route::has('activities.index'))
                <a href="{{ route('activities.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat semua</a>
                @endif
            </div>

            <ul class="space-y-3">
                @forelse($recentActivities ?? [] as $act)
                <li class="flex items-start space-x-3 dark:space-x-reverse rtl:space-x-reverse">
                    <img class="w-10 h-10 rounded-full" src="{{ $act['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($act['user'] ?? 'User') }}" alt="avatar">
                    <div class="flex-1">
                        <div class="text-sm text-gray-700 dark:text-gray-200">
                            <span class="font-semibold">{{ $act['user'] ?? 'User' }}</span>
                            <span class="text-gray-500 dark:text-gray-400"> — {{ $act['action'] ?? 'melakukan aksi' }}</span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $act['time'] ?? 'baru saja' }}</div>
                    </div>
                </li>
                @empty
                <li class="text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas terbaru.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const labels = @json($stockLabels ?? []);
        const values = @json($stockValues ?? []);

        const canvas = document.getElementById('stockChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stok',
                    data: values,
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99,102,241,0.08)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#6B7280' } },
                    y: { beginAtZero: true, ticks: { color: '#6B7280' } }
                }
            }
        });

        document.getElementById('period')?.addEventListener('change', function(){
            // fetch(`/dashboard/data?days=${this.value}`)...
        });
    })();
</script>
@endpush
</x-layout>
