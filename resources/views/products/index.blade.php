<x-layout title="Produk">
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
        transform: scale(1.005);
    }

    .action-button {
        transition: all 0.2s ease;
    }

    .action-button:hover {
        transform: scale(1.1);
    }

    .search-input:focus {
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between mb-8 fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Manajemen Produk</h1>
            <p class="text-purple-100">Kelola semua produk inventory Anda 📦</p>
        </div>
        <div class="flex items-center space-x-3 mt-4 sm:mt-0">
            @if (auth()->check() && auth()->user()->isAdmin())
                <button data-modal-target="categoryModal" data-modal-toggle="categoryModal"
                    class="glass-button px-4 py-3 rounded-xl text-sm font-semibold text-green-700 border border-green-200 shadow-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Kategori
                </button>
            @endif

            <a href="{{ route('products.create') }}"
                class="px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Search & Filter -->
    <form method="GET" class="mb-6 fade-in">
        <div class="glass-card rounded-2xl shadow-xl p-4">
            <div class="flex flex-wrap gap-3">
                <input name="q" value="{{ request('q') }}"
                    class="search-input flex-1 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:border-indigo-400 focus:outline-none transition-all"
                    placeholder="🔍 Cari nama produk atau SKU...">

                <select name="category"
                    class="border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:border-indigo-400 focus:outline-none transition-all">
                    <option value="">📂 Semua Kategori</option>
                    @foreach ($categories ?? \App\Models\Category::orderBy('name')->get() as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <button class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <!-- Products Table -->
    <div class="glass-card rounded-2xl shadow-2xl overflow-hidden fade-in">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                        <th class="px-6 py-4 text-left text-sm font-bold">#</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">SKU</th>
                        <th class="px-6 py-4 text-left text-sm font-bold">Kategori</th>
                        <th class="px-6 py-4 text-right text-sm font-bold">Stok</th>
                        <th class="px-6 py-4 text-right text-sm font-bold">Harga</th>
                        <th class="px-6 py-4 text-center text-sm font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-gray-600 font-semibold">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($product->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-semibold">
                                    {{ $product->sku }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-sm font-semibold">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 {{ $product->stock > 10 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg text-sm font-bold">
                                    {{ $product->stock ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-gray-800">
                                Rp {{ number_format($product->selling_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('products.show', $product) }}"
                                        class="action-button px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-semibold hover:bg-blue-200 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="action-button px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg font-semibold hover:bg-indigo-200 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button"
                                        onclick="showDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="action-button px-4 py-2 bg-red-100 text-red-700 rounded-lg font-semibold hover:bg-red-200 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
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

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div class="inline-block align-bottom glass-card rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Hapus Produk?</h3>
                </div>
                <p class="text-gray-600 mb-6">Anda yakin ingin menghapus produk <strong id="productName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-6 py-3 border-2 border-gray-200 rounded-xl font-semibold hover:bg-gray-100 transition-all">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full backdrop-blur-sm bg-black/50">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
        <div class="relative glass-card rounded-3xl shadow-2xl">
            <button type="button"
                class="absolute top-4 right-4 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-xl p-2 transition-all"
                data-modal-toggle="categoryModal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Tambah Kategori</h3>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="category_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Kategori
                        </label>
                        <input type="text" name="name" id="category_name" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-400 focus:outline-none transition-all font-medium"
                            placeholder="Contoh: Elektronik">
                    </div>
                    <div class="mb-6">
                        <label for="category_description"
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi (Opsional)
                        </label>
                        <textarea name="description" id="category_description" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-400 focus:outline-none transition-all font-medium"
                            placeholder="Deskripsi kategori..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" data-modal-toggle="categoryModal"
                            class="px-6 py-3 border-2 border-gray-200 rounded-xl font-semibold hover:bg-gray-100 transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showDeleteModal(productId, productName) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('deleteForm').action = `/products/${productId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
</x-layout>
