<x-layout title="Daftar Transaksi Stok">
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi Stok</h1>
            <a href="{{ route('stocks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Tambah Transaksi
            </a>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Keterangan</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $stock->product->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $stock->quantity }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs
                                    {{ $stock->type == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($stock->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $stock->notes ?? '-' }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('stocks.edit', $stock->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline"
                                        onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $stocks->links() }}
        </div>
    </div>
</x-layout>
