<x-layout title="Edit Produk">
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

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }
    </style>

    <div class="container mx-auto p-4 md:p-8">
        <!-- Header with Breadcrumb -->
        <div class="mb-8 fade-in">
            <div class="flex items-center text-sm text-purple-100 mb-3">
                <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-semibold">Edit Produk</span>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Edit Produk</h1>
            <p class="text-purple-100">Perbarui informasi produk 📝</p>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('general'))
            <div class="mb-6 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 rounded-xl shadow-lg fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-yellow-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-yellow-800 font-semibold">{{ session('general') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl shadow-lg fade-in">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-red-800 font-semibold mb-2">Terdapat beberapa kesalahan:</p>
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $err)
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>{{ $err }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="glass-card rounded-3xl shadow-2xl p-8 fade-in">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Nama Produk -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <input name="name" value="{{ old('name', $product->name ?? '') }}"
                                class="input-field w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 font-medium focus:outline-none"
                                placeholder="Masukkan nama produk" required>
                        </div>
                    </div>

                    <!-- SKU -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            SKU (Stock Keeping Unit)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div>
                            <input name="sku" value="{{ old('sku', $product->sku ?? '') }}"
                                class="input-field w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 font-medium focus:outline-none"
                                placeholder="Contoh: PRD-001">
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <select name="category_id"
                                class="input-field w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 font-medium focus:outline-none appearance-none bg-white">
                                <option value="">-- Pilih kategori --</option>
                                @foreach (\App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga Jual
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-semibold">Rp</span>
                            </div>
                            <input name="selling_price" value="{{ old('selling_price', $product->selling_price ?? '') }}" type="text" inputmode="decimal"
                                class="input-field w-full border-2 border-gray-200 rounded-xl pl-14 pr-4 py-3 font-medium focus:outline-none"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <input name="stock" value="{{ old('stock', $product->stock ?? 0) }}" type="number"
                                class="input-field w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 font-medium focus:outline-none"
                                placeholder="0">
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Upload Gambar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar Produk
                        </label>
                        <div class="upload-area rounded-xl p-8 text-center">
                            <div id="preview-container" class="{{ $product->image ? '' : 'hidden' }} mb-4">
                                <img id="image-preview"
                                     src="{{ $product->image ? Storage::url($product->image) : '' }}"
                                     class="mx-auto rounded-xl shadow-lg max-h-48 object-cover">
                            </div>
                            <label for="image-input" class="cursor-pointer">
                                <div id="upload-placeholder" class="{{ $product->image ? 'hidden' : '' }}">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 font-semibold mb-1">Upload gambar produk</p>
                                    <p class="text-gray-400 text-sm">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Produk
                        </label>
                        <textarea name="description" rows="8"
                            class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none resize-none"
                            placeholder="Tuliskan deskripsi produk...">{{ old('description', $product->description ?? '') }}</textarea>
                        <p class="text-gray-400 text-xs mt-2">Jelaskan detail produk, spesifikasi, atau informasi penting lainnya</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('products.index') }}"
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all text-center">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </span>
                </a>
                <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all text-center">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Produk
                    </span>
                </button>
                <button type="submit"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    <span class="inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full backdrop-blur-sm bg-black/50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
            <div class="relative glass-card rounded-3xl shadow-2xl">
                <button type="button"
                    class="absolute top-4 right-4 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-xl p-2 transition-all"
                    data-modal-toggle="deleteModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Hapus Produk?</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Anda yakin ingin menghapus produk <strong>{{ $product->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-end gap-3">
                        <button type="button" data-modal-toggle="deleteModal"
                            class="px-6 py-3 border-2 border-gray-200 rounded-xl font-semibold hover:bg-gray-100 transition-all">
                            Batal
                        </button>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image Preview
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-layout>
