<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $r)
    {
        $q = $r->query('q');
        $categoryId = $r->query('category');

        $products = Product::with('category')
            ->when($q, fn($qb) => $qb->where(function ($q2) use ($q) {
                $q2->where('name', 'like', '%' . $q . '%')
                    ->orWhere('sku', 'like', '%' . $q . '%');
            }))
            ->when($categoryId, fn($qb) => $qb->where('category_id', $categoryId))
            ->paginate(15);

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info('Product store request (raw)', ['selling_price_raw' => $request->input('selling_price')]);

        // normalize price
        $rawPrice = $request->input('selling_price', '');
        if ($rawPrice !== null && $rawPrice !== '') {
            $p = preg_replace('/\s+/', '', (string) $rawPrice);
            if (strpos($p, ',') !== false) {
                $p = str_replace('.', '', $p);
                $p = str_replace(',', '.', $p);
            } elseif (strpos($p, '.') !== false) {
                $parts = explode('.', $p);
                $last = end($parts);
                if (strlen($last) === 3) {
                    $p = str_replace('.', '', $p);
                }
            }
            if ($p !== '' && !is_numeric($p)) {
                return back()->withInput()->withErrors(['selling_price' => 'Format harga tidak valid.']);
            }
            $request->merge(['selling_price' => $p]);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'sku' => ['nullable', 'string', Rule::unique('products', 'sku')],
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'selling_price' => 'nullable|numeric', // Ubah dari 'price'
            'stock' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // generate SKU if empty
        if (empty($data['sku'])) {
            do {
                $sku = 'SKU-' . Str::upper(Str::random(8));
            } while (Product::where('sku', $sku)->exists());
            $data['sku'] = $sku;
        }

        // handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $columns = Schema::getColumnListing('products');
        $data = array_intersect_key($data, array_flip($columns));

        try {
            $product = Product::create($data);
            Log::info('Product created', ['id' => $product->id, 'selling_price_saved' => $product->selling_price ?? null]);
            return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Product create failed', ['err' => $e->getMessage(), 'data' => $data]);
            return back()->withInput()->withErrors(['general' => 'Gagal menyimpan produk: ' . $e->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sku' => ['nullable', 'string', Rule::unique('products', 'sku')->ignore($product->id)],
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'selling_price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'notes' => 'nullable|string'
        ]);

        // filter kolom sesuai schema
        $columns = Schema::hasTable('products') ? Schema::getColumnListing('products') : [];
        $data = array_intersect_key($data, array_flip($columns));

        try {
            $product->update($data);
            Log::info('Product updated', ['id' => $product->id]);
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Product update failed', ['err' => $e->getMessage(), 'id' => $product->id, 'data' => $data]);
            return back()->withInput()->withErrors(['general' => 'Gagal memperbarui produk. Periksa input atau cek log.']);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk dihapus.');
    }

    public function import(Request $r)
    {
        // terima file CSV, parse dan buat produk
        // implement sesuai kebutuhan (contoh: use maatwebsite/excel)
        return back()->with('success', 'Import diproses.');
    }

    public function export()
    {
        // export CSV/xlsx; gunakan paket export atau manual
        return redirect()->back();
    }
}
