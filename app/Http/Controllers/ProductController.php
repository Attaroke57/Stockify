<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $r)
    {
        $q = $r->query('q');
        $products = Product::when($q, fn($qBuilder)=>$qBuilder->where('name','like','%'.$q.'%')->orWhere('sku','like','%'.$q.'%'))
            ->paginate(15);
        return view('products.index', compact('products'));
    }

    public function create(){ return view('products.create'); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'=>'required|string',
            'sku'=>'nullable|string',
            'category_id'=>'nullable|exists:categories,id',
            'price'=>'nullable|numeric',
            'stock'=>'nullable|integer',
            'description'=>'nullable|string'
        ]);
        $product = Product::create($data);
        // handle attributes separately
        return redirect()->route('products.index')->with('success','Produk disimpan.');
    }

    public function edit(Product $product){ return view('products.edit', compact('product')); }

    public function update(Request $r, Product $product)
    {
        $data = $r->validate([
            'name'=>'required',
            'sku'=>'nullable',
            'category_id'=>'nullable|exists:categories,id',
            'price'=>'nullable|numeric',
            'stock'=>'nullable|integer',
            'description'=>'nullable|string'
        ]);
        $product->update($data);
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
