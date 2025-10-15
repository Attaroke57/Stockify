<x-layout title="Tambah Produk">
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

    .input-field {
        transition: all 0.3s ease;
    }

    .input-field:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        cursor: pointer;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .upload-area.dragover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header with Breadcrumb -->
    <div class="mb-8 fade-in">
        <div class="flex items-center text-sm text-purple-100 mb-3">
            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">Tambah Produk Baru</span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-2">Tambah Produk Baru</h1>
        <p class="text-purple-100">Lengkapi formulir di bawah untuk menambahkan produk 📦</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg fade-in">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('general'))
    <div class="mb-6 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 rounded-xl shadow-lg fade-in">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-yellow-800 font-semibold">{{ session('general') }}</p>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl shadow-lg fade-in">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-red-800 font-semibold mb-2">Terdapat beberapa kesalahan:</p>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $err)
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
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="glass-card rounded-3xl shadow-2xl p-8 fade-in">
        @csrf

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <input name="name" value="{{ old('name') }}"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                        </div>
                        <input name="sku" value="{{ old('sku') }}"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <select name="category_id"
                            class="input-field w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 font-medium focus:outline-none appearance-none bg-white">
                            <option value="">-- Pilih kategori --</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
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
                        <input name="price" value="{{ old('price', '') }}" type="text" inputmode="decimal"
                            class="input-field w-full border-2 border-gray-200 rounded-xl pl-14 pr-4 py-3 font-medium focus:outline-none"
                            placeholder="0">
                    </div>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Stok Awal
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <input name="stock" value="{{ old('stock', 0) }}" type="number"
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
                        <div class="file-input-wrapper">
                            <label for="image-input" class="cursor-pointer">
                                <div id="preview-container" class="hidden mb-4">
                                    <img id="image-preview" class="mx-auto rounded-xl shadow-lg max-h-48 object-cover">
                                </div>
                                <div id="upload-placeholder">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 font-semibold mb-1">Upload gambar produk</p>
                                    <p class="text-gray-400 text-sm">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Produk
                    </label>
                    <textarea name="description" rows="8"
                        class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none resize-none"
                        placeholder="Tuliskan deskripsi produk...">{{ old('description') }}</textarea>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </span>
            </a>
            <button type="submit"
                class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                <span class="inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Produk
                </span>
            </button>
        </div>
    </form>

    <!-- Tips Card -->
    <div class="mt-6 glass-card rounded-2xl shadow-xl p-6 fade-in">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 mb-2">💡 Tips Menambahkan Produk</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Gunakan nama produk yang jelas dan deskriptif</li>
                    <li>• SKU membantu Anda melacak produk dengan mudah</li>
                    <li>• Upload gambar berkualitas baik untuk tampilan yang profesional</li>
                    <li>• Pastikan kategori produk sudah sesuai</li>
                </ul>
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

    // Drag and drop
    const uploadArea = document.querySelector('.upload-area');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('dragover');
        });
    });

    uploadArea.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        imageInput.files = files;

        const event = new Event('change', { bubbles: true });
        imageInput.dispatchEvent(event);
    });
</script>

</x-layout>
