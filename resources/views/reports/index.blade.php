<x-layout title="Laporan">
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Laporan</h1>
            <p class="text-gray-600">Akses berbagai laporan sistem inventori</p>
        </div>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Stock Report Card -->
            <a href="{{ route('reports.stock') }}" class="block group">
                <div class="h-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all duration-300 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg group-hover:bg-blue-600 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            Inventory
                        </span>
                    </div>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                        Laporan Stok Barang
                    </h5>
                    <p class="mb-4 font-normal text-gray-700 text-sm">
                        Lihat status stok semua produk berdasarkan kategori
                    </p>
                    <div class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Transaction Report Card -->
            <a href="{{ route('reports.transactions') }}" class="block group">
                <div class="h-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all duration-300 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg group-hover:bg-green-600 transition-colors duration-300">
                            <svg class="w-6 h-6 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            Transaksi
                        </span>
                    </div>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                        Laporan Transaksi
                    </h5>
                    <p class="mb-4 font-normal text-gray-700 text-sm">
                        Riwayat transaksi barang masuk dan keluar
                    </p>
                    <div class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Activity Report Card -->
            <a href="{{ route('reports.activities') }}" class="block group">
                <div class="h-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all duration-300 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg group-hover:bg-yellow-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            User Activity
                        </span>
                    </div>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                        Laporan Aktivitas
                    </h5>
                    <p class="mb-4 font-normal text-gray-700 text-sm">
                        Pantau aktivitas pengguna dalam sistem
                    </p>
                    <div class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-medium">
                        <span class="text-sm">Lihat Laporan</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</x-layout>
