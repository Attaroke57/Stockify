<x-layout>
    <x-slot:title>Edit Supplier</x-slot:title>

    <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Edit Supplier</h1>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-md">
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-900">
                        Nama Supplier <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $supplier->name) }}"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           placeholder="Masukkan nama supplier" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-900">Alamat</label>
                    <textarea id="address" name="address" rows="3"
                              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap">{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-900">Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}"
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                               placeholder="08123456789">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-900">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $supplier->email) }}"
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                               placeholder="supplier@example.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                        Update
                    </button>
                    <a href="{{ route('suppliers.index') }}"
                       class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
