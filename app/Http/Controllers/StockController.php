<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = StockTransaction::with('product')->latest()->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stocks.create', compact('products'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',

        ]);

        $validated['date'] = $request->input('date') ?: now()->format('mm-dd-yyyy');

        StockTransaction::create($validated);

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $stock = StockTransaction::findOrFail($id);
        $products = Product::all();
        return view('stocks.edit', compact('stock', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'notes' => 'nullable|string|max:255',
        ]);

        $stock = StockTransaction::findOrFail($id);
        $stock->update($validated);



        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $stock = StockTransaction::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil dihapus.');
    }

}
