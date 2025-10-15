<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm">Nama</label>
        <input name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div>
        <label class="block text-sm">SKU</label>
        <input name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Kategori</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
            <option value="">-- Pilih kategori --</option>
            @foreach (\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm">Harga</label>
        <input name="selling_price" value="{{ old('selling_price', $product->selling_price ?? '') }}" type="number"
            class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Stok</label>
        <input name="stock" value="{{ old('stock', $product->stock ?? 0) }}" type="number"
            class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Atribut</label>
        <div class="space-y-1">
            @foreach (\App\Models\Attribute::with('options')->get() as $attr)
                <div class="text-sm">
                    <div class="font-medium">{{ $attr->name }}</div>
                    @if ($attr->options->count())
                        <select name="attributes[{{ $attr->id }}]" class="w-full border rounded px-2 py-1">
                            <option value="">-- Pilih --</option>
                            @foreach ($attr->options as $opt)
                                <option value="{{ $opt->id }}" @selected(old("attributes.$attr->id", optional($product)->attributeValue($attr->id)) == $opt->id)>{{ $opt->value }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input name="attributes[{{ $attr->id }}]" value="{{ old("attributes.$attr->id") }}"
                            class="w-full border rounded px-2 py-1" placeholder="Masukkan nilai">
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm">Deskripsi</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
</div>
