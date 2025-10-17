<x-layout title="Dashboard">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-card {
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .icon-wrapper {
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .chart-container {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
    }

    select {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    select:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
    }

    .fade-in {
        animation: fadeIn 0.6s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    .stagger-4 { animation-delay: 0.4s; }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between mb-8 fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Dashboard</h1>
            <p class="text-purple-100">Selamat datang kembali! 👋</p>
        </div>
        <div>
            <select id="periodSelect" class="border-0 text-gray-700 font-medium text-sm rounded-xl shadow-lg px-6 py-3 focus:ring-4 focus:ring-purple-300 focus:outline-none cursor-pointer">
                <option value="hari">📅 Hari ini</option>
                <option value="minggu" selected>📊 Minggu ini</option>
                <option value="bulan">📈 Bulan ini</option>
                <option value="tahun">🎯 Tahun ini</option>
            </select>
        </div>
    </div>

    <!-- Summary cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Jumlah Produk -->
        <div class="glass-card stat-card p-6 rounded-2xl shadow-xl fade-in stagger-1">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jumlah Produk</p>
                    <p class="text-3xl font-bold gradient-text">{{ $productCount ?? 0 }}</p>
                </div>
                <div class="icon-wrapper p-4 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-gray-500">Total produk terdaftar</span>
            </div>
        </div>

        <!-- Card 2: Transaksi Masuk -->
        <div class="glass-card stat-card p-6 rounded-2xl shadow-xl fade-in stagger-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Transaksi Masuk</p>
                    <p class="text-3xl font-bold text-green-600">{{ $incomingCount ?? 0 }}</p>
                </div>
                <div class="icon-wrapper p-4 bg-gradient-to-br from-green-400 to-emerald-600 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-gray-500">Barang masuk periode ini</span>
            </div>
        </div>

        <!-- Card 3: Transaksi Keluar -->
        <div class="glass-card stat-card p-6 rounded-2xl shadow-xl fade-in stagger-3">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Transaksi Keluar</p>
                    <p class="text-3xl font-bold text-red-600">{{ $outgoingCount ?? 0 }}</p>
                </div>
                <div class="icon-wrapper p-4 bg-gradient-to-br from-red-400 to-rose-600 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-gray-500">Barang keluar periode ini</span>
            </div>
        </div>

        <!-- Card 4: Total Stok -->
        <div class="glass-card stat-card p-6 rounded-2xl shadow-xl fade-in stagger-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Stok</p>
                    <p class="text-3xl font-bold text-amber-600">{{ $totalStock ?? 0 }}</p>
                </div>
                <div class="icon-wrapper p-4 bg-gradient-to-br from-amber-400 to-orange-600 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-gray-500">Jumlah stok semua produk</span>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="chart-container rounded-3xl shadow-2xl p-8 mb-8 fade-in">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold gradient-text mb-1">Grafik Transaksi Barang</h2>
                <p class="text-gray-500 text-sm">Perbandingan barang masuk dan keluar</p>
            </div>
            <div class="flex space-x-2">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-indigo-500 mr-2"></div>
                    <span class="text-sm text-gray-600 font-medium">Masuk</span>
                </div>
                <div class="flex items-center ml-4">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <span class="text-sm text-gray-600 font-medium">Keluar</span>
                </div>
            </div>
        </div>
        <div class="h-80">
            <canvas id="stockChart"></canvas>
        </div>
    </div>

<!-- Aktivitas Terbaru -->
    <div class="glass-card rounded-3xl shadow-2xl p-8 fade-in">
        <h2 class="text-2xl font-bold gradient-text mb-6">Aktivitas Terbaru</h2>

        @if(isset($recentActivities) && $recentActivities->count() > 0)
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                <div class="flex items-center justify-between p-4 bg-white rounded-xl hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-xl {{ $activity->type === 'in' ? 'bg-green-100' : 'bg-red-100' }}">
                            @if($activity->type === 'in')
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $activity->product->name ?? 'Produk tidak ditemukan' }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $activity->type === 'in' ? 'Barang Masuk' : 'Barang Keluar' }} •
                                {{ $activity->quantity }} unit
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        <p class="text-xs text-gray-400">{{ $activity->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Belum ada aktivitas terbaru</p>
                <p class="text-gray-400 text-sm mt-1">Aktivitas transaksi akan muncul di sini</p>
            </div>
        @endif
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById("stockChart").getContext("2d");
    const periodSelect = document.getElementById("periodSelect");

    async function fetchData(period = "minggu") {
        try {
            const response = await fetch(`/dashboard/data/${period}`);
            const data = await response.json();

            return {
                labels: data.labels || [],
                incoming: data.incoming || [],
                outgoing: data.outgoing || [],
            };
        } catch (error) {
            console.error("Error fetching data:", error);
            return { labels: [], incoming: [], outgoing: [] };
        }
    }

    let chart;
    async function renderChart(period = "minggu") {
        const { labels, incoming, outgoing } = await fetchData(period);

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels,
                datasets: [
                    {
                        label: "Barang Masuk",
                        data: incoming,
                        backgroundColor: "rgba(99, 102, 241, 0.8)",
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: "Barang Keluar",
                        data: outgoing,
                        backgroundColor: "rgba(239, 68, 68, 0.8)",
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 12, weight: '500' } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { size: 12, weight: '500' } }
                    },
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 }
                    }
                },
            },
        });
    }

    await renderChart();

    periodSelect.addEventListener("change", (e) => {
        renderChart(e.target.value);
    });
});
</script>

</x-layout>
