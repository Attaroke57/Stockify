<x-layout title="Laporan Stok">
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

    .table-row {
        background: rgba(255, 255, 255, 0.6);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
    }

    .table-row:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: scale(1.01);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
    }

    .input-field {
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
    }

    .input-field:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-gradient:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(102, 126, 234, 0.4);
    }

    .btn-light {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(209, 213, 219, 0.5);
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(99, 102, 241, 0.3);
        transform: translateY(-2px);
    }

    .row-badge {
        transition: all 0.3s ease;
    }

    .table-row:hover .row-badge {
        transform: scale(1.05);
    }
</style>

<div class="min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header with Breadcrumb -->
        <div class="mb-8 fade-in">
            <div class="flex items-center text-sm text-purple-100 mb-3">
                <a href="{{ route('reports.index') }}" class="hover:text-white transition-colors">Laporan</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-semibold">Laporan Stok Barang</span>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Laporan Stok Barang</h1>
            <p class="text-purple-100">Lihat status stok semua produk berdasarkan kategori 📦</p>
        </div>

        <!-- Filter Card -->
        <div class="glass-card rounded-3xl shadow-2xl p-6 mb-6 fade-in">
            <form method="GET" class="flex flex-wrap gap-3">
                <select name="category" class="input-field flex-1 min-w-fit border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none appearance-none bg-white">
                    <option value="">📂 Semua Kategori</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                <button class="btn-gradient px-6 py-3 text-white rounded-xl font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('reports.stock.export', request()->query()) }}" class="btn-light px-6 py-3 text-gray-700 rounded-xl font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </a>
            </form>
        </div>

        <!-- Table Card -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden fade-in">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                            <th class="px-6 py-4 text-left text-sm font-bold">#</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Nama Produk</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">SKU</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Kategori</th>
                            <th class="px-6 py-4 text-right text-sm font-bold">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $p)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-gray-600 font-semibold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($p->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $p->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="row-badge px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-semibold">
                                    {{ $p->sku }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="row-badge px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-sm font-semibold">
                                    {{ $p->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="row-badge px-3 py-1 {{ $p->stock > 10 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg text-sm font-bold">
                                    {{ $p->stock ?? 0 }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-semibold text-lg">Tidak ada produk ditemukan</p>
                                    <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau tambah produk baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</x-layout>
