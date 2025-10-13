<x-layout title="Tambah Produk">
<div class="container mx-auto p-4">
    <h1 class="text-xl mb-4">Tambah Produk</h1>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if(session('general'))
    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded">
        {{ session('general') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded">
        <ul class="text-sm">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
        @csrf
        <label class="block text-sm">Nama</label>
        <input name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2 mb-3" required>

        <label class="block text-sm">SKU</label>
        <input name="sku" value="{{ old('sku') }}" class="w-full border rounded px-3 py-2 mb-3">

        <label class="block text-sm">Kategori</label>
        <select name="category_id" class="w-full border rounded px-3 py-2 mb-3">
            <option value="">-- Pilih kategori --</option>
            @foreach($categories ?? [] as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <label class="block text-sm">Harga</label>
        <input
            name="price"
            value="{{ old('price', '') }}"
            type="text"
            inputmode="decimal"

            class="w-full border rounded px-3 py-2 mb-3"
        >

        <label class="block text-sm">Stok</label>
        <input name="stock" value="{{ old('stock', 0) }}" type="number" class="w-full border rounded px-3 py-2 mb-3">

        <label class="block text-sm">Gambar</label>
        <input type="file" name="image" accept="image/*" class="w-full mb-3">

        <label class="block text-sm">Deskripsi</label>
        <textarea name="description" class="w-full border rounded px-3 py-2 mb-3">{{ old('description') }}</textarea>

        <div class="flex gap-2">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded">Batal</a>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
</x-layout>
