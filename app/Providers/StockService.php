<?php

namespace App\Services;

use App\Repositories\StockTransactionRepository;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StockService
{
    protected $repo;

    public function __construct(StockTransactionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function addStock($productId, $quantity, $note = null)
    {
        $product = Product::findOrFail($productId);
        $product->increment('stock', $quantity);

        $this->repo->create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'type' => 'Masuk',
            'quantity' => $quantity,
            'status' => 'Diterima',
            'date' => now(),
            'notes' => $note,
        ]);
    }

    public function reduceStock($productId, $quantity, $note = null)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            throw new \Exception('Stok tidak cukup!');
        }

        $product->decrement('stock', $quantity);

        $this->repo->create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'type' => 'Keluar',
            'quantity' => $quantity,
            'status' => 'Dikeluarkan',
            'date' => now(),
            'notes' => $note,
        ]);
    }
}
