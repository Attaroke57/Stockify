<x-layout>
    <x-slot:title>Daftar Supplier</x-slot:title>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Supplier</h1>
            <a href="{{ route('suppliers.create') }}"
               class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                <svg class="me-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Tambah Supplier
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-sm text-green-800" role="alert">
                <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Supplier</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">Telepon</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $key => $supplier)
                    <tr class="border-b bg-white hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $suppliers->firstItem() + $key }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $supplier->name }}</td>
                        <td class="px-6 py-4">{{ $supplier->address ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $supplier->phone ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $supplier->email ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('suppliers.show', $supplier->id) }}"
                                   class="font-medium text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                   class="font-medium text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b bg-white">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data supplier</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </div>
</x-layout>
