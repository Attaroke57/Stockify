<x-layout title="Produk">
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Manajemen Produk</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Tambah Produk</a>
            <button data-modal-target="importModal" data-modal-toggle="importModal" class="px-4 py-2 rounded border bg-white hover:bg-gray-50">Import</button>
            <a href="{{ route('products.export') }}" class="px-4 py-2 rounded border bg-white hover:bg-gray-50">Export</a>
        </div>
    </div>

    <form method="GET" class="mb-4">
        <div class="flex gap-2">
            <input name="q" value="{{ request('q') }}" class="flex-1 border rounded px-3 py-2" placeholder="Cari nama / SKU...">
            <select name="category" class="border rounded px-2 py-2">
                <option value="">Semua kategori</option>
                @foreach($categories ?? \App\Models\Category::orderBy('name')->get() as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Cari</button>
        </div>
    </form>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">#</th>
                    <th class="px-4 py-2 text-left text-sm">Nama</th>
                    <th class="px-4 py-2 text-left text-sm">SKU</th>
                    <th class="px-4 py-2 text-left text-sm">Kategori</th>
                    <th class="px-4 py-2 text-right text-sm">Stok</th>
                    <th class="px-4 py-2 text-right text-sm">Harga</th>
                    <th class="px-4 py-2 text-center text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr>
                    <td class="px-4 py-3">{{ $loop->iteration + ($products->currentPage()-1)*$products->perPage() }}</td>
                    <td class="px-4 py-3">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->sku }}</td>
                    <td class="px-4 py-3">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-right">{{ $product->stock ?? 0 }}</td>
                    <td class="px-4 py-3 text-right">Rp {{ number_format($product->selling_price ?? 0, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Tidak ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>

<!-- Import Modal (Flowbite) -->
<div id="importModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
      <button type="button" class="absolute top-3 right-2.5 text-gray-400" data-modal-toggle="importModal">×</button>
      <div class="p-6">
        <h3 class="mb-4 text-lg font-medium">Import Produk (CSV)</h3>
        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv" required class="mb-4">
            <div class="flex justify-end gap-2">
                <button type="button" data-modal-toggle="importModal" class="px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Import</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // nothing required here; Flowbite handles modal via data attributes
</script>
@endpush
</x-layout>
