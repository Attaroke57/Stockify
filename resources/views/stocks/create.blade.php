<x-layout title="Tambah Transaksi Stok">
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

    .input-field {
        transition: all 0.3s ease;
    }

    .input-field:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header with Breadcrumb -->
    <div class="mb-8 fade-in">
        <div class="flex items-center text-sm text-purple-100 mb-3">
            <a href="{{ route('stocks.index') }}" class="hover:text-white transition-colors">Transaksi Stok</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">Tambah Transaksi</span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-2">Tambah Transaksi Stok</h1>
        <p class="text-purple-100">Lengkapi formulir untuk menambahkan transaksi stok 📦</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-3xl shadow-2xl p-8 fade-in">
        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf

            <!-- Pilih Produk -->
            <div class="mb-6">
                <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Pilih Produk <span class="text-red-500">*</span>
                </label>
                <select name="product_id" id="product_id"
                    class="input-field w-full border-2 @error('product_id') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 font-medium focus:outline-none" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Grid: Tipe & Jumlah -->
            <div class="mb-6 grid gap-6 md:grid-cols-2">
                <!-- Tipe Transaksi -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tipe Transaksi <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type"
                        class="input-field w-full border-2 @error('type') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 font-medium focus:outline-none" required>
                        <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>↑ Masuk</option>
                        <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>↓ Keluar</option>
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity') }}"
                        class="input-field w-full border-2 @error('quantity') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 font-medium focus:outline-none"
                        placeholder="Masukkan jumlah" required>
                    @error('quantity')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Grid: Supplier & Tanggal -->
            <div class="mb-6 grid gap-6 md:grid-cols-2">
                <!-- Pilih Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Supplier (opsional)
                    </label>
                    <select name="supplier_id" id="supplier_id"
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Transaksi -->
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Transaksi <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                        class="input-field w-full border-2 @error('date') border-red-500 @else border-gray-200 @enderror rounded-xl px-4 py-3 font-medium focus:outline-none" required>
                    @error('date')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Keterangan -->
            <div class="mb-6">
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="notes" id="notes" rows="3"
                    class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none resize-none"
                    placeholder="Tambahkan catatan atau keterangan (opsional)">{{ old('notes') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('stocks.index') }}"
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all text-center">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </span>
                </a>
                <button type="submit"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    <span class="inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Transaksi
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Card -->
    <div class="mt-6 glass-card rounded-2xl shadow-xl p-6 fade-in">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 mb-2">💡 Tips Transaksi Stok</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• <strong>Masuk (In)</strong>: Untuk penambahan stok dari supplier atau produksi</li>
                    <li>• <strong>Keluar (Out)</strong>: Untuk pengurangan stok akibat penjualan atau kerusakan</li>
                    <li>• Pastikan jumlah stok mencukupi sebelum melakukan transaksi keluar</li>
                    <li>• Tambahkan keterangan untuk memudahkan pelacakan transaksi</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</x-layout>
