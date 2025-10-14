<x-layout title="Tambah Transaksi Stok">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Transaksi Stok</h1>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="product_id" class="block text-gray-700 font-medium mb-2">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="w-full border-gray-300 rounded-lg shadow-sm p-2">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="supplier_id" class="block text-gray-700 font-medium mb-2">Pilih Supplier (opsional)</label>
                    <select name="supplier_id" id="supplier_id" class="w-full border-gray-300 rounded-lg shadow-sm p-2">
                        <option value="">-- Pilih Supplier --   </option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-medium mb-2">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" min="1"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-2" required>
                    @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-gray-700 font-medium mb-2">Tipe Transaksi</label>
                    <select name="type" id="type" class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                        required>
                        <option value="in">Masuk</option>
                        <option value="out">Keluar</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-gray-700 font-medium mb-1">Tanggal Transaksi</label>
                    <input type="date" name="date" required
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="notes" class="block text-gray-700 font-medium mb-2">Keterangan</label>
                    <textarea name="notes" id="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm p-2"></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('stocks.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
