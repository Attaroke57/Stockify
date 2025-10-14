<x-layout>
    <x-slot:title>Detail Supplier</x-slot:title>

    <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Supplier</h1>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-md">
            <dl class="divide-y divide-gray-200">
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Nama Supplier</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $supplier->name }}</dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Kontak Person</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $supplier->contact_person ?? '-' }}
                    </dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $supplier->address ?? '-' }}</dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Telepon</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $supplier->phone ?? '-' }}</dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Email</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">{{ $supplier->email ?? '-' }}</dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Dibuat Pada</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $supplier->created_at->format('d M Y H:i') }}</dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium text-gray-900">Terakhir Update</dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $supplier->updated_at->format('d M Y H:i') }}</dd>
                </div>
            </dl>

            <div class="mt-6 flex space-x-3">
                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                    class="rounded-lg bg-yellow-400 px-5 py-2.5 text-sm font-medium text-white hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                    Edit
                </a>
                <a href="{{ route('suppliers.index') }}"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200">
                    Kembali
                </a>
                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
