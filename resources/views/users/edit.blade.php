<x-layout title="Edit Pengguna">
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Pengguna</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" readonly
                    class="w-full border-gray-300 bg-gray-100 rounded-lg shadow-sm cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Role</label>
                <select name="role" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manajer Gudang</option>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff Gudang</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password (opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ubah password"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-layout>
