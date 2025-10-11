<x-layout title="Tambah Pengguna Baru">
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Pengguna Baru</h1>

        <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Role</label>
                <select name="role" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="admin">Admin</option>
                    <option value="manager">Manajer Gudang</option>
                    <option value="staff">Staff Gudang</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
            <a href="{{ route('users.index') }}" class="text-gray-600 ml-4 hover:underline">Batal</a>
        </form>
    </div>
</x-layout>
