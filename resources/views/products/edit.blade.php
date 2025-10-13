<x-layout title="Edit Produk">
<div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold">Edit Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui detail produk dan atributnya.</p>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('products.index') }}" class="px-3 py-2 border rounded text-sm">Kembali</a>

            <!-- Delete button (opens modal) -->
            <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="px-3 py-2 bg-red-600 text-white rounded text-sm">Hapus</button>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if(session('general'))
    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded">
        {{ session('general') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded">
        <ul class="text-sm">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white dark:bg-gray-800 border rounded-lg p-5 shadow">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                    <input name="name" value="{{ old('name', $product->name ?? '') }}" required class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">SKU</label>
                    <input name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kategori</label>
                    <select name="category_id" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">
                        <option value="">-- Pilih kategori --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Supplier</label>
                    <select name="supplier_id" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">
                        <option value="">-- Pilih supplier --</option>
                        @foreach(\App\Models\Supplier::all() as $s)
                        <option value="{{ $s->id }}" @selected(old('supplier_id', $product->supplier_id ?? '') == $s->id)>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Harga</label>
                    <input name="price" type="number" step="0.01" value="{{ old('price', isset($product->price) ? number_format($product->price, 2, '.', '') : '') }}" class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Stok</label>
                    <input name="stock" type="number" value="{{ old('stock', $product->stock ?? 0) }}" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Gambar Produk</label>
                    <input name="image" type="file" accept="image/*" class="mt-1 w-full">
                    @if(!empty($product->image))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="preview" class="h-20 rounded">
                    </div>
                    @endif
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-black">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>

            <!-- Attributes -->
            <div class="mt-4 border-t pt-4">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Atribut</h3>
                <div class="space-y-3">
                    @foreach(\App\Models\Attribute::with('options')->get() as $attr)
                    <div>
                        <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $attr->name }}</div>
                        @if($attr->options->count())
                        <select name="attributes[{{ $attr->id }}]" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Pilih --</option>
                            @foreach($attr->options as $opt)
                            <option value="{{ $opt->id }}" @selected(old("attributes.{$attr->id}", optional($product)->attributeValue($attr->id)) == $opt->id)>{{ $opt->value }}</option>
                            @endforeach
                        </select>
                        @else
                        <input name="attributes[{{ $attr->id }}]" value="{{ old("attributes.{$attr->id}", optional($product)->attributeValue($attr->id)) }}" class="mt-1 w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-500">Terakhir diubah: {{ $product->updated_at->diffForHumans() ?? '-' }}</div>
                <div class="space-x-2">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded">Batal</a>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete confirmation modal (Flowbite) -->
<div id="deleteModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
      <button type="button" class="absolute top-3 right-2.5 text-gray-400" data-modal-toggle="deleteModal">×</button>
      <div class="p-6">
        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Hapus Produk</h3>
        <p class="text-sm text-gray-500 mb-4">Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button data-modal-toggle="deleteModal" class="px-4 py-2 border rounded">Batal</button>
            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
    // minimal client-side helpers (preview image)
    document.querySelector('input[name="image"]')?.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(!file) return;
        const img = document.createElement('img');
        img.className = 'h-20 rounded mt-2';
        img.src = URL.createObjectURL(file);
        const parent = e.target.parentElement;
        const existing = parent.querySelector('img');
        if(existing) existing.remove();
        parent.appendChild(img);
    });
</script>
@endpush
</x-layout>
