<x-layout title="Detail Transaksi">
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

        .info-badge {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-left: 4px solid #667eea;
        }

        .badge-in {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(21, 128, 61, 0.1) 100%);
            border-left: 4px solid #22c55e;
        }

        .badge-out {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(185, 28, 28, 0.1) 100%);
            border-left: 4px solid #ef4444;
        }
    </style>

    <div class="container mx-auto p-4 md:p-8">
        <!-- Header dengan Breadcrumb -->
        <div class="mb-8 fade-in">
            <div class="flex items-center text-sm text-purple-100 mb-3">
                <a href="{{ route('reports.index') }}" class="hover:text-white transition-colors">Laporan</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('reports.transactions') }}" class="hover:text-white transition-colors">Laporan
                    Transaksi</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-semibold">Detail Transaksi</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Detail Transaksi</h1>
                    <p class="text-purple-100">Informasi lengkap transaksi barang 📋</p>
                </div>
                <a href="{{ route('reports.transactions') }}"
                    class="px-4 py-3 bg-white/90 backdrop-blur-sm text-gray-700 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Product Information -->
                <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 012 12V7a2 2 0 012-2z" />
                        </svg>
                        Informasi Produk
                    </h2>
                    <div class="space-y-4">
                        <div class="info-badge rounded-xl p-6">
                            <div class="flex items-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl mr-4">
                                    {{ substr($stock->product->name ?? 'P', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-500 mb-1">Nama Produk</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $stock->product->name ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="info-badge rounded-xl p-4">
                                <p class="text-sm font-semibold text-gray-500 mb-2">Kategori</p>
                                <span
                                    class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-sm font-bold inline-block">
                                    {{ $stock->product->category->name ?? '-' }}
                                </span>
                            </div>
                            <div class="info-badge rounded-xl p-4">
                                <p class="text-sm font-semibold text-gray-500 mb-2">SKU</p>
                                <p class="text-lg font-bold text-gray-800">{{ $stock->product->sku ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Detail Transaksi
                    </h2>
                    <div class="space-y-4">
                        <div class="{{ $stock->type === 'in' ? 'badge-in' : 'badge-out' }} rounded-xl p-6">
                            <p class="text-sm font-semibold text-gray-500 mb-2">Tipe Transaksi</p>
                            <div class="flex items-center">
                                <span
                                    class="px-4 py-2 {{ $stock->type === 'in' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg text-sm font-bold">
                                    {{ $stock->type === 'in' ? '📥 Barang Masuk' : '📤 Barang Keluar' }}
                                </span>
                                <p class="ml-4 text-lg font-bold text-gray-800">
                                    {{ $stock->type === 'in' ? 'Penambahan Stok' : 'Pengurangan Stok' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="info-badge rounded-xl p-6">
                                <p class="text-sm font-semibold text-gray-500 mb-2">Jumlah</p>
                                <p class="text-3xl font-bold text-indigo-600">{{ $stock->quantity ?? 0 }}</p>
                                <p class="text-sm text-gray-500 mt-1">unit</p>
                            </div>
                            <div class="info-badge rounded-xl p-6">
                                <p class="text-sm font-semibold text-gray-500 mb-2">Tanggal Transaksi</p>
                                <p class="text-lg font-bold text-gray-800">
                                    {{ $stock->created_at->format('d M Y') }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">{{ $stock->created_at->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if ($stock->notes)
                    <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Catatan
                        </h2>
                        <p class="text-gray-700 leading-relaxed">{{ $stock->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Right Column - Summary & Actions -->
            <div class="space-y-6">
                <!-- Summary Card -->
                <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan</h2>
                    <div class="space-y-4">
                        <div class="info-badge rounded-xl p-4">
                            <p class="text-xs font-semibold text-gray-500 mb-1">Harga Satuan</p>
                            <p class="text-xl font-bold text-gray-800">
                                Rp {{ number_format($stock->product->price ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="info-badge rounded-xl p-4">
                            <p class="text-xs font-semibold text-gray-500 mb-1">Total Nilai</p>
                            <p class="text-2xl font-bold text-green-600">
                                Rp
                                {{ number_format(($stock->product->price ?? 0) * ($stock->quantity ?? 0), 0, ',', '.') }}
                            </p>
                        </div>

                        <div
                            class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-4 border border-purple-100">
                            <p class="text-xs font-semibold text-gray-500 mb-2">Status</p>
                            <span
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold inline-block">
                                ✓ Tercatat
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timestamps -->
                <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Riwayat</h2>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-500">Dibuat</span>
                            <span class="font-semibold text-gray-700">
                                {{ $stock->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Diperbarui</span>
                            <span class="font-semibold text-gray-700">
                                {{ $stock->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in space-y-3">
                    <a href="{{ route('reports.transactions') }}"
                        class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kembali ke Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
