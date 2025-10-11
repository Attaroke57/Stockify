<x-layout title="Tambah Produk">
<div class="container mx-auto p-4">
    <h1 class="text-xl font-semibold mb-4">Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @include('products._form', ['product' => null])
        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded mr-2">Batal</a>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
</x-layout>
