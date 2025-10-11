<x-layout title="Detail Stok">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white">Detail Stok</h1>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <p class="mb-2"><strong>Nama Produk:</strong> {{ $stock->product->nama ?? '-' }}</p>
            <p class="mb-2"><strong>Kategori:</strong> {{ $stock->product->kategori->nama ?? '-' }}</p>
            <p class="mb-2"><strong>Jumlah:</strong> {{ $stock->jumlah }}</p>
            <p class="mb-2"><strong>Satuan:</strong> {{ $stock->satuan ?? 'pcs' }}</p>
            <p class="mb-2"><strong>Harga:</strong> Rp{{ number_format($stock->product->harga ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mt-6">
            <a href="{{ route('stocks.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Kembali</a>
        </div>
    </div>
</x-layout>
