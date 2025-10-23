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
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .report-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .report-card:hover::before {
        left: 100%;
    }

    .report-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px -15px rgba(102, 126, 234, 0.4);
        border-color: rgba(255, 255, 255, 0.6);
    }

    .icon-box {
        position: relative;
        transition: all 0.3s ease;
    }

    .report-card:hover .icon-box {
        transform: scale(1.1) rotate(-5deg);
    }

    .icon-box::after {
        content: '';
        position: absolute;
        inset: 0;
        background: inherit;
        border-radius: inherit;
        opacity: 0;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    .card-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
    }

    .report-card:hover .card-title {
        transform: translateX(2px);
    }

    .badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        animation: slideIn 0.6s ease backwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .cta-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cta-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: width 0.3s ease;
    }

    .report-card:hover .cta-link::after {
        width: 100%;
    }

    .arrow-icon {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .report-card:hover .arrow-icon {
        transform: translateX(6px);
    }
</style>

<div class="min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="mb-12 fade-in">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-5xl font-bold text-white mb-2">Laporan</h1>
                    <p class="text-purple-100 text-lg">Akses berbagai laporan sistem inventori 📊</p>
                </div>
            </div>
        </div>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">
            <!-- Stock Report Card -->
            <a href="{{ route('reports.stock') }}" class="block group">
                <div class="report-card rounded-2xl shadow-xl p-8 h-full">
                    <div class="flex items-start justify-between mb-8">
                        <div class="icon-box w-16 h-16 bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center relative">
                            <svg class="w-8 h-8 text-indigo-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="badge px-4 py-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full text-xs font-bold shadow-lg">Inventory</span>
                    </div>
                    <h5 class="card-title text-2xl font-bold mb-3">Laporan Stok Barang</h5>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Lihat status stok semua produk berdasarkan kategori dengan analisis real-time</p>
                    <div class="cta-link">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-5 h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Transaction Report Card -->
            <a href="{{ route('reports.transactions') }}" class="block group">
                <div class="report-card rounded-2xl shadow-xl p-8 h-full">
                    <div class="flex items-start justify-between mb-8">
                        <div class="icon-box w-16 h-16 bg-gradient-to-br from-purple-100 via-pink-100 to-red-100 rounded-2xl flex items-center justify-center relative">
                            <svg class="w-8 h-8 text-purple-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                        </div>
                        <span class="badge px-4 py-1 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-full text-xs font-bold shadow-lg">Transaksi</span>
                    </div>
                    <h5 class="card-title text-2xl font-bold mb-3">Laporan Transaksi</h5>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Riwayat transaksi barang masuk dan keluar dengan detail lengkap</p>
                    <div class="cta-link">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-5 h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Activity Report Card - Hanya untuk Admin -->
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('reports.activities') }}" class="block group">
                <div class="report-card rounded-2xl shadow-xl p-8 h-full">
                    <div class="flex items-start justify-between mb-8">
                        <div class="icon-box w-16 h-16 bg-gradient-to-br from-amber-100 via-orange-100 to-red-100 rounded-2xl flex items-center justify-center relative">
                            <svg class="w-8 h-8 text-amber-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="badge px-4 py-1 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-full text-xs font-bold shadow-lg">Admin Only</span>
                    </div>
                    <h5 class="card-title text-2xl font-bold mb-3">Laporan Aktivitas</h5>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Pantau aktivitas pengguna dalam sistem untuk audit dan keamanan</p>
                    <div class="cta-link">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-5 h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endif
        </div>
    </div>
</div>

</x-layout>
