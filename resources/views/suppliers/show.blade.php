<x-layout>
    <x-slot:title>Detail Supplier</x-slot:title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
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

    .info-row {
        transition: all 0.2s ease;
    }

    .info-row:hover {
        background: rgba(99, 102, 241, 0.03);
    }
</style>

<div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header with Breadcrumb -->
    <div class="mb-8 fade-in">
        <div class="flex items-center text-sm text-purple-100 mb-3">
            <a href="{{ route('suppliers.index') }}" class="hover:text-white transition-colors">Supplier</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">Detail Supplier</span>
        </div>
        <div class="flex items-center">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl">
                    {{ substr($supplier->name, 0, 1) }}
                </div>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-white mb-1">{{ $supplier->name }}</h1>
                <p class="text-purple-100">Informasi lengkap supplier 📋</p>
            </div>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="glass-card rounded-3xl shadow-2xl overflow-hidden fade-in">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Informasi Supplier</h2>
        </div>

        <div class="p-8">
            <dl class="space-y-1">
                <!-- Nama Supplier -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Nama Supplier
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">{{ $supplier->name }}</dd>
                </div>

                <!-- Kontak Person -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Kontak Person
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $supplier->contact_person ?? '-' }}
                    </dd>
                </div>

                <!-- Alamat -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Alamat
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $supplier->address ?? '-' }}
                    </dd>
                </div>

                <!-- Telepon -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Telepon
                    </dt>
                    <dd class="text-sm sm:col-span-2">
                        @if($supplier->phone)
                            <a href="tel:{{ $supplier->phone }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-semibold hover:bg-blue-200 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $supplier->phone }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </dd>
                </div>

                <!-- Dibuat Pada -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Dibuat Pada
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $supplier->created_at->format('d M Y H:i') }} WIB
                    </dd>
                </div>

                <!-- Terakhir Update -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Terakhir Update
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $supplier->updated_at->format('d M Y H:i') }} WIB
                    </dd>
                </div>

                <!-- Email -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email
                    </dt>
                    <dd class="text-sm sm:col-span-2">
                        @if($supplier->email)
                            <a href="mailto:{{ $supplier->email }}" class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-700 rounded-lg font-semibold hover:bg-purple-200 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $supplier->email }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex gap-3">
        <a href="{{ route('suppliers.index') }}"
           class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        <a href="{{ route('suppliers.edit', $supplier) }}"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Supplier
        </a>
    </div>
</div>

</x-layout>
