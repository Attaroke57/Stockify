<x-layout>
    <x-slot:title>Detail Produk</x-slot:title>

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

<div class="mx-auto max-w-4xl px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header with Breadcrumb -->
    <div class="mb-8 fade-in">
        <div class="flex items-center text-sm text-purple-100 mb-3">
            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">Detail Produk</span>
        </div>
        <div class="flex items-center">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl">
                    {{ substr($product->name, 0, 1) }}
                </div>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-white mb-1">{{ $product->name }}</h1>
                <p class="text-purple-100">Informasi lengkap produk 📦</p>
            </div>
        </div>
    </div>

    <!-- Product Image Card (if exists) -->
   <!-- Product Image Card (if exists) -->
@if($product->image)
<div class="glass-card rounded-3xl shadow-2xl overflow-hidden mb-6 fade-in">
    <div class="p-6">
        <div class="relative">
            <!-- Coba 3 cara sekaligus -->
            <img src="{{ Storage::url($product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full max-h-96 object-contain rounded-2xl bg-gray-50 mb-2"
                 onerror="this.style.display='none'">

            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full max-h-96 object-contain rounded-2xl bg-gray-50 mb-2"
                 onerror="this.style.display='none'">

            <img src="{{ asset($product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full max-h-96 object-contain rounded-2xl bg-gray-50"
                 onerror="this.style.display='none'">
        </div>
    </div>
</div>
@else
<div class="glass-card rounded-3xl shadow-2xl overflow-hidden mb-6 fade-in">
    <div class="p-6 text-center">
        <p class="text-gray-500">Tidak ada gambar untuk produk ini</p>
    </div>
</div>
@endif

    <!-- Detail Card -->
    <div class="glass-card rounded-3xl shadow-2xl overflow-hidden fade-in">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Informasi Produk</h2>
        </div>

        <div class="p-8">
            <dl class="space-y-1">
                <!-- Nama Produk -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Nama Produk
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">{{ $product->name }}</dd>
                </div>

                <!-- SKU -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                        SKU
                    </dt>
                    <dd class="text-sm sm:col-span-2">
                        <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-bold">
                            {{ $product->sku }}
                        </span>
                    </dd>
                </div>

                <!-- Kategori -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Kategori
                    </dt>
                    <dd class="text-sm sm:col-span-2">
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg text-sm font-bold">
                            {{ $product->category->name ?? '-' }}
                        </span>
                    </dd>
                </div>

                <!-- Supplier -->
                @if($product->supplier)
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Supplier
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $product->supplier->name }}
                    </dd>
                </div>
                @endif

                <!-- Stok -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        Stok Tersedia
                    </dt>
                    <dd class="text-sm sm:col-span-2">
                        <span class="px-4 py-2 rounded-lg text-sm font-bold {{ $product->stock > 10 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock ?? 0 }} Unit
                        </span>
                    </dd>
                </div>

                <!-- Harga Jual -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Harga Jual
                    </dt>
                    <dd class="text-sm text-gray-800 font-bold sm:col-span-2 text-lg">
                        Rp {{ number_format($product->selling_price ?? 0, 0, ',', '.') }}
                    </dd>
                </div>

                <!-- Deskripsi -->
                @if($product->description)
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Deskripsi
                    </dt>
                    <dd class="text-sm text-gray-800 sm:col-span-2">
                        {{ $product->description }}
                    </dd>
                </div>
                @endif

                <!-- Dibuat Pada -->
                <div class="info-row px-4 py-4 rounded-xl grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <dt class="text-sm font-bold text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Dibuat Pada
                    </dt>
                    <dd class="text-sm text-gray-800 font-semibold sm:col-span-2">
                        {{ $product->created_at->format('d M Y H:i') }} WIB
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
                        {{ $product->updated_at->format('d M Y H:i') }} WIB
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex gap-3">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        <a href="{{ route('products.edit', $product) }}"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Produk
        </a>
    </div>
</div>

</x-layout>
