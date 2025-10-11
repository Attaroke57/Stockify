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
            ->when($q, fn($qb) => $qb->where(function($q2) use ($q) {
                $q2->where('name', 'like', '%'.$q.'%')
                   ->orWhere('sku', 'like', '%'.$q.'%');
            }))
            ->when($categoryId, fn($qb) => $qb->where('category_id', $categoryId))
            ->paginate(15);

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create(){ return view('products.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sku' => 'nullable|string|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // jika sku kosong -> generate unik
        if (empty($data['sku'])) {
            do {
                $sku = 'SKU-' . Str::upper(Str::random(8));
            } while (Schema::hasTable('products') && Product::where('sku', $sku)->exists());
            $data['sku'] = $sku;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // hanya gunakan kolom yang ada di tabel
        $columns = Schema::hasTable('products') ? Schema::getColumnListing('products') : [];
        $data = array_intersect_key($data, array_flip($columns));

        try {
            $product = Product::create($data);
        } catch (\Exception $e) {
            \Log::error('Product create error: '.$e->getMessage(), ['data'=>$data]);
            return back()->withInput()->withErrors(['general'=>'Gagal menyimpan produk. Cek log.']);
        }

        return redirect()->route('products.index')->with('success','Produk disimpan.');
    }

    public function edit(Product $product){ return view('products.edit', compact('product')); }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'=>'required|string',
            'sku'=>['nullable','string', Rule::unique('products','sku')->ignore($product->id)],
            'category_id'=>'nullable|exists:categories,id',
            'supplier_id'=>'nullable|exists:suppliers,id',
            'price'=>'nullable|numeric',
            'stock'=>'nullable|integer',
            'description'=>'nullable|string'
        ]);

        // filter kolom sesuai schema
        $columns = Schema::hasTable('products') ? Schema::getColumnListing('products') : [];
        $data = array_intersect_key($data, array_flip($columns));

        try {
            $product->update($data);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withInput()->withErrors(['sku' => 'Terjadi kesalahan saat memperbarui. Pastikan SKU unik.']);
        }

        return redirect()->route('products.index')->with('success','Produk diperbarui.');
    }

    public function destroy(Product $product){ $product->delete(); return back()->with('success','Produk dihapus.'); }

    public function import(Request $r)
    {
        // terima file CSV, parse dan buat produk
        // implement sesuai kebutuhan (contoh: use maatwebsite/excel)
        return back()->with('success','Import diproses.');
    }

    public function export()
    {
        // export CSV/xlsx; gunakan paket export atau manual
        return redirect()->back();
    }
}
