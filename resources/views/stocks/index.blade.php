<x-layout title="Daftar Transaksi Stok">
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

    .glass-button {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .glass-button:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
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

    .table-row {
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: scale(1.01);
    }

    .action-button {
        transition: all 0.2s ease;
    }

    .action-button:hover {
        transform: scale(1.1);
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between mb-8 fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Transaksi Stok</h1>
            <p class="text-purple-100">Kelola semua transaksi stok masuk & keluar 📊</p>
        </div>
        <a href="{{ route('stocks.create') }}"
            class="px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center mt-4 sm:mt-0">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Transaksi
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg fade-in">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl shadow-lg fade-in">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-red-800 font-semibold">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Table Card -->
    <div class="glass-card rounded-2xl shadow-2xl overflow-hidden fade-in">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                        <th class="px-6 py-4 text-left text-sm font-bold">#</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Produk</th>
                        <th class="px-6 py-4 text-center text-sm font-bold">Jumlah</th>
                        <th class="px-6 py-4 text-center text-sm font-bold">Tipe</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Keterangan</th>
                        <th class="px-6 py-4 text-center text-sm font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($stocks as $stock)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-gray-600 font-semibold">
                                {{ $loop->iteration + ($stocks->currentPage() - 1) * $stocks->perPage() }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($stock->product->name ?? 'N', 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $stock->product->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-bold">
                                    {{ $stock->quantity }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-4 py-2 rounded-lg text-sm font-bold {{ $stock->type == 'in' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $stock->type == 'in' ? '↑ Masuk' : '↓ Keluar' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $stock->notes ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('stocks.edit', $stock->id) }}"
                                        class="action-button px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg font-semibold hover:bg-indigo-200 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('⚠ Yakin ingin menghapus transaksi ini?')">
                                        @csrf @method('DELETE')
                                        <button class="action-button px-4 py-2 bg-red-100 text-red-700 rounded-lg font-semibold hover:bg-red-200 inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-semibold text-lg">Tidak ada transaksi ditemukan</p>
                                    <p class="text-gray-400 text-sm mt-1">Mulai tambahkan transaksi stok baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $stocks->links() }}
    </div>
</div>
</x-layout>
