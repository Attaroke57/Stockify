<x-layout>
    <div class="container mx-auto px-6 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Pengguna</h1>
            <a href="{{ route('users.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Tambah Pengguna
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                    @foreach ($users as $i => $user)
                        <tr>
                            <td class="px-6 py-3">{{ $i + 1 }}</td>
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <span
                                    class="px-2 py-1 text-xs rounded-full
                            @if ($user->role == 'admin') bg-blue-100 text-blue-700
                            @elseif($user->role == 'manager') bg-yellow-100 text-yellow-700
                            @else bg-green-100 text-green-700 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold mr-2">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                                        class="text-red-600 hover:text-red-800 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
