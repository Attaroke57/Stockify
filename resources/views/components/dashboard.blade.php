<x-layout title="Dashboard">
<div class="container mx-auto p-4">
    <!-- Header -->
       <div class="flex flex-wrap items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Dashboard</h1>
        <div>
            <select id="periodSelect" class="border border-gray-300 text-gray-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
                <option value="hari">Hari ini</option>
                <option value="minggu" selected>Minggu ini</option>
                <option value="bulan">Bulan ini</option>
                <option value="tahun">Tahun ini</option>
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

    <!-- Grafik -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Grafik Transaksi Barang</h2>
        <div class="h-80">
            <canvas id="stockChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Aktivitas Terbaru</h2>
        <p class="text-sm text-gray-500">Belum ada aktivitas terbaru.</p>
    </div>
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
                        backgroundColor: "rgba(37, 99, 235, 0.7)",
                        borderRadius: 6,
                    },
                    {
                        label: "Barang Keluar",
                        data: outgoing,
                        backgroundColor: "rgba(239, 68, 68, 0.7)",
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true },
                },
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: { usePointStyle: true },
                    },
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
