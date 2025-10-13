<x-layout title="Laporan Stok">
<div class="container mx-auto p-4">
    <h1 class="text-xl mb-4">Laporan Stok Barang</h1>

    <form method="GET" class="mb-4">
        <div class="flex gap-2">
            <select name="category" class="border rounded px-2 py-2">
                <option value="">Semua Kategori</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            <button class="px-3 py-2 bg-indigo-600 text-white rounded">Filter</button>
            <a href="{{ route('reports.stock.export', request()->query()) }}" class="px-3 py-2 border rounded">Export CSV</a>
        </div>
    </form>

    <div class="bg-white border rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2 text-left">SKU</th>
                    <th class="p-2 text-left">Kategori</th>
                    <th class="p-2 text-right">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2">{{ $p->sku }}</td>
                    <td class="p-2">{{ $p->category->name ?? '-' }}</td>
                    <td class="p-2 text-right">{{ $p->stock ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-4 text-center">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layout>
