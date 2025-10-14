<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Supplier;

class StockController extends Controller
{
    public function index()
    {
        $stocks = StockTransaction::with(['product', 'supplier'])->latest()->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('stocks.create', compact('products', 'suppliers')); // ← FIX: Tambah 'suppliers'
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'notes' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        // Create stock transaction
        StockTransaction::create($validated);

        // Update product stock
        $product = Product::findOrFail($validated['product_id']);
        if ($validated['type'] === 'in') {
            $product->increment('stock', $validated['quantity']);
        } else {
            // Check if stock is sufficient for 'out' transaction
            if ($product->stock < $validated['quantity']) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi!'])->withInput();
            }
            $product->decrement('stock', $validated['quantity']);
        }

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $stock = StockTransaction::findOrFail($id);
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('stocks.edit', compact('stock', 'products', 'suppliers')); // ← FIX: Tambah 'suppliers'
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'notes' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $stock = StockTransaction::findOrFail($id);

        // Revert old stock changes
        $oldProduct = Product::findOrFail($stock->product_id);
        if ($stock->type === 'in') {
            $oldProduct->decrement('stock', $stock->quantity);
        } else {
            $oldProduct->increment('stock', $stock->quantity);
        }

        // Update transaction
        $stock->update($validated);

        // Apply new stock changes
        $newProduct = Product::findOrFail($validated['product_id']);
        if ($validated['type'] === 'in') {
            $newProduct->increment('stock', $validated['quantity']);
        } else {
            // Check if stock is sufficient for 'out' transaction
            if ($newProduct->stock < $validated['quantity']) {
                // Revert back the old transaction
                if ($stock->type === 'in') {
                    $oldProduct->increment('stock', $stock->quantity);
                } else {
                    $oldProduct->decrement('stock', $stock->quantity);
                }
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi!'])->withInput();
            }
            $newProduct->decrement('stock', $validated['quantity']);
        }

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $stock = StockTransaction::findOrFail($id);

        // Revert stock before delete
        $product = Product::findOrFail($stock->product_id);
        if ($stock->type === 'in') {
            $product->decrement('stock', $stock->quantity);
        } else {
            $product->increment('stock', $stock->quantity);
        }

        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil dihapus.');
    }
}
