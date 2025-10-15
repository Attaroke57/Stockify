<x-layout>
    <x-slot:title>Daftar Supplier</x-slot:title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .fade-in {
        animation: fadeIn 0.6s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table-row {
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: rgba(99, 102, 241, 0.05);
        transform: scale(1.005);
    }

    .action-button {
        transition: all 0.2s ease;
    }

    .action-button:hover {
        transform: scale(1.1);
    }
</style>

<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-wrap items-center justify-between fade-in">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Daftar Supplier</h1>
            <p class="text-purple-100">Kelola semua supplier Anda 🏢</p>
        </div>
        <a href="{{ route('suppliers.create') }}"
            class="mt-4 sm:mt-0 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            Tambah Supplier
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg fade-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div>
                    <span class="font-bold text-green-800">Sukses!</span>
                    <span class="text-green-700"> {{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

<!-- Table -->
<div class="glass-card rounded-2xl shadow-2xl overflow-hidden fade-in">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <th class="px-4 py-4 text-left text-xs font-bold">No</th>
                    <th class="px-4 py-4 text-left text-xs font-bold">Supplier</th>
                    <th class="px-4 py-4 text-left text-xs font-bold">Kontak</th>
                    <th class="px-4 py-4 text-center text-xs font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($suppliers as $key => $supplier)
                <tr class="table-row bg-white">
                    <td class="px-4 py-4 text-gray-600 font-semibold text-sm">
                        {{ $suppliers->firstItem() + $key }}
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3 flex-shrink-0">
                                {{ substr($supplier->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-800 text-sm truncate">{{ $supplier->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ $supplier->contact_person ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="space-y-1">
                            @if($supplier->phone)
                                <div class="flex items-center text-xs text-blue-700">
                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="truncate">{{ $supplier->phone }}</span>
                                </div>
                            @endif
                            @if($supplier->email)
                                <div class="flex items-center text-xs text-purple-700">
                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="truncate">{{ $supplier->email }}</span>
                                </div>
                            @endif
                            @if(!$supplier->phone && !$supplier->email)
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center space-x-1">
                            <a href="{{ route('suppliers.show', $supplier->id) }}"
                                class="action-button p-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                class="action-button p-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('⚠️ Yakin ingin menghapus supplier ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button p-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-semibold text-lg">Tidak ada data supplier</p>
                            <p class="text-gray-400 text-sm mt-1">Mulai tambahkan supplier baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $suppliers->links() }}
    </div>
</div>
</x-layout>
