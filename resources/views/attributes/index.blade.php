<x-layout title="Atribut Produk">
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">Atribut</h1>
        <a href="{{ route('attributes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Atribut</a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50"><tr><th class="px-4 py-2">Nama</th><th class="px-4 py-2">Opsi</th><th class="px-4 py-2">Aksi</th></tr></thead>
            <tbody>
                @forelse($attributes as $attr)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $attr->name }}</td>
                    <td class="px-4 py-2">{{ $attr->options->pluck('value')->join(', ') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('attributes.edit', $attr) }}" class="text-indigo-600">Edit</a>
                        <form action="{{ route('attributes.destroy', $attr) }}" method="POST" class="inline-block">@csrf @method('DELETE')<button class="text-red-600 ml-2">Hapus</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada atribut</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layout>
