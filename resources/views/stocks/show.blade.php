<x-layout title="Detail Stok">
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
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Detail Stok</h1>
            <p class="text-purple-100">Informasi lengkap stok produk 📋</p>
        </div>
        <a href="{{ route('stocks.index') }}"
            class="px-4 py-3 bg-white/90 backdrop-blur-sm text-gray-700 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Detail Card -->
    <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
        <div class="space-y-6">
            <!-- Product Info -->
            <div class="info-badge rounded-xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4">
                        {{ substr($stock->product->name ?? 'N', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Nama Produk</p>
                        <p class="text-xl font-bold text-gray-800">{{ $stock->product->name ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Category -->
            <div class="info-badge rounded-xl p-6">
                <p class="text-sm font-semibold text-gray-500 mb-2">Kategori</p>
                <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg text-sm font-bold inline-block">
                    {{ $stock->product->category->name ?? '-' }}
                </span>
            </div>

            <!-- Stock Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Jumlah -->
                <div class="info-badge rounded-xl p-6">
                    <p class="text-sm font-semibold text-gray-500 mb-2">Jumlah Stok</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $stock->quantity }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $stock->unit ?? 'pcs' }}</p>
                </div>

                <!-- Price -->
                <div class="info-badge rounded-xl p-6">
                    <p class="text-sm font-semibold text-gray-500 mb-2">Harga Satuan</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stock->product->price ?? 0, 0, ',', '.') }}</p>
                </div>

                <!-- Total Value -->
                <div class="info-badge rounded-xl p-6">
                    <p class="text-sm font-semibold text-gray-500 mb-2">Total Nilai</p>
                    <p class="text-2xl font-bold text-green-600">
                        Rp {{ number_format(($stock->product->price ?? 0) * $stock->quantity, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="pt-6 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-500 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Terakhir diperbarui: {{ $stock->updated_at->diffForHumans() ?? '-' }}
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('stocks.edit', $stock->id) }}"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Stok
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
