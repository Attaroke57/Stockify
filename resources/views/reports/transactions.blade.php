<x-layout title="Laporan Transaksi">
<div class="container mx-auto p-4">
    <h1 class="text-xl mb-4">Laporan Transaksi Barang</h1>

    <form method="GET" class="mb-4 flex gap-2 items-center">
        <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2 py-1">
        <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2 py-1">
        <select name="type" class="border rounded px-2 py-1">
            <option value="">Semua</option>
            <option value="in" @selected(request('type')=='in')>Masuk</option>
            <option value="out" @selected(request('type')=='out')>Keluar</option>
        </select>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded">Filter</button>
        <a href="{{ route('reports.transactions.export', request()->query()) }}" class="px-3 py-2 border rounded">Export CSV</a>
    </form>

    <div class="bg-white border rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-2">#</th>
                    <th class="p-2">Produk</th>
                    <th class="p-2">Tipe</th>
                    <th class="p-2 text-right">Jumlah</th>
                    <th class="p-2">User</th>
                    <th class="p-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $t->product->name ?? '-' }}</td>
                    <td class="p-2">{{ $t->type }}</td>
                    <td class="p-2 text-right">{{ $t->quantity ?? '-' }}</td>
                    <td class="p-2">{{ $t->user->name ?? '-' }}</td>
                    <td class="p-2">{{ $t->created_at }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-4 text-center">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layout>
