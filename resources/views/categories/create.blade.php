<x-layout title="Tambah Kategori">
<div class="container mx-auto p-4">
    <h1 class="text-lg font-semibold mb-4">Tambah Kategori</h1>
    <form action="{{ route('categories.store') }}" method="POST">@csrf
        <label class="block text-sm">Nama</label>
        <input name="name" class="w-full border rounded px-3 py-2 mb-4" required>
        <div>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 border rounded mr-2">Batal</a>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
</x-layout>
