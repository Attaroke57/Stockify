<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

class StockOutService
{
    protected $productRepo;
    protected $transactionRepo;

    public function __construct(ProductRepository $productRepo, TransactionRepository $transactionRepo)
    {
        $this->productRepo = $productRepo;
        $this->transactionRepo = $transactionRepo;
    }

    public function reduceStock($productId, $quantity, $note)
    {
        $product = $this->productRepo->find($productId);

        if ($product->stock < $quantity) {
            return ['message' => 'Stok tidak cukup', 'status' => 400];
        }

        $this->productRepo->decreaseStock($productId, $quantity);

        $this->transactionRepo->create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'type' => 'keluar',
            'quantity' => $quantity,
            'note' => $note
        ]);

        return ['message' => 'Barang keluar berhasil dicatat', 'status' => 201];
    }
}
