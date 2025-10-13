<x-layout title="Laporan">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Laporan</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('reports.stock') }}" class="p-4 border rounded hover:shadow">Laporan Stok Barang</a>
        <a href="{{ route('reports.transactions') }}" class="p-4 border rounded hover:shadow">Laporan Transaksi Masuk/Keluar</a>
        <a href="{{ route('reports.activities') }}" class="p-4 border rounded hover:shadow">Laporan Aktivitas Pengguna</a>
    </div>
</div>
</x-layout>
