<x-layout title="Edit Transaksi Stok">
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

    .input-field {
        transition: all 0.3s ease;
    }

    .input-field:focus {
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        border-color: #667eea;
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Edit Transaksi Stok</h1>
            <p class="text-purple-100">Perbarui detail transaksi stok ✏</p>
        </div>
        <a href="{{ route('stocks.index') }}"
            class="px-4 py-3 bg-white/90 backdrop-blur-sm text-gray-700 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl shadow-2xl p-8 fade-in">
        <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Produk -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Produk <span class="text-red-500">*</span>
                    </label>
                    <select name="product_id" required
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:outline-none">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $stock->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="quantity" required min="1" value="{{ $stock->quantity }}"
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:outline-none">
                </div>

                <!-- Tipe Transaksi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tipe Transaksi <span class="text-red-500">*</span>
                    </label>
                    <select name="type" required
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:outline-none">
                        <option value="in" {{ $stock->type == 'in' ? 'selected' : '' }}>↑ Masuk</option>
                        <option value="out" {{ $stock->type == 'out' ? 'selected' : '' }}>↓ Keluar</option>
                    </select>
                </div>

                <!-- Keterangan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                    <textarea name="notes" rows="4"
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-medium focus:outline-none"
                        placeholder="Tambahkan catatan atau keterangan (opsional)">{{ $stock->notes }}</textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('stocks.index') }}"
                    class="px-6 py-3 border-2 border-gray-200 rounded-xl font-semibold text-gray-700 hover:bg-gray-100 transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</x-layout>
