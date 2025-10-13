<x-layout title="Edit Transaksi Stok">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Transaksi Stok</h1>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('stocks.update', $stock->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                    <select name="product_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $stock->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="quantity" required min="1"
                        value="{{ $stock->quantity }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Transaksi</label>
                    <select name="type" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="in" {{ $stock->type == 'in' ? 'selected' : '' }}>Masuk</option>
                        <option value="out" {{ $stock->type == 'out' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>

                <div>
                   <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="notes" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $stock->notes }}</textarea>

                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('stocks.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
