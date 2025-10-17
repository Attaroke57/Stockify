<x-layout title="Laporan">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
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

    .report-card {
        transition: all 0.3s ease;
    }

    .report-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(102, 126, 234, 0.2);
    }
</style>

<div class="min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="mb-8 fade-in">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Laporan</h1>
                    <p class="text-purple-100">Akses berbagai laporan sistem inventori 📊</p>
                </div>
            </div>
        </div>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
            <!-- Stock Report Card -->
            <a href="{{ route('reports.stock') }}" class="block group">
                <div class="report-card glass-card rounded-3xl shadow-2xl p-6 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-bold">Inventory</span>
                    </div>
                    <h5 class="text-xl font-bold text-gray-800 mb-2">Laporan Stok Barang</h5>
                    <p class="text-gray-600 text-sm mb-4">Lihat status stok semua produk berdasarkan kategori</p>
                    <div class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Transaction Report Card -->
            <a href="{{ route('reports.transactions') }}" class="block group">
                <div class="report-card glass-card rounded-3xl shadow-2xl p-6 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-xs font-bold">Transaksi</span>
                    </div>
                    <h5 class="text-xl font-bold text-gray-800 mb-2">Laporan Transaksi</h5>
                    <p class="text-gray-600 text-sm mb-4">Riwayat transaksi barang masuk dan keluar</p>
                    <div class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Activity Report Card -->
            <a href="{{ route('reports.activities') }}" class="block group">
                <div class="report-card glass-card rounded-3xl shadow-2xl p-6 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold">User Activity</span>
                    </div>
                    <h5 class="text-xl font-bold text-gray-800 mb-2">Laporan Aktivitas</h5>
                    <p class="text-gray-600 text-sm mb-4">Pantau aktivitas pengguna dalam sistem</p>
                    <div class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

</x-layout>
