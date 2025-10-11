<x-layout title="Kategori">
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">Kategori Produk</h1>
        <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah</a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50"><tr><th class="px-4 py-2">Nama</th><th class="px-4 py-2">Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-t"><td class="px-4 py-2">{{ $category->name }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">@csrf @method('DELETE')<button class="text-red-600 ml-2">Hapus</button></form>
                </td></tr>
                @empty
                <tr><td colspan="2" class="px-4 py-4 text-center text-gray-500">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
</x-layout>
