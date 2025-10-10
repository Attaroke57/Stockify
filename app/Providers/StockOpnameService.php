<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\StockOpnameRepository;
use Illuminate\Support\Facades\Auth;

class StockOpnameService
{
    protected $productRepo;
    protected $opnameRepo;

    public function __construct(ProductRepository $productRepo, StockOpnameRepository $opnameRepo)
    {
        $this->productRepo = $productRepo;
        $this->opnameRepo = $opnameRepo;
    }

    public function record($productId, $actualStock, $note)
    {
        $product = $this->productRepo->find($productId);
        $difference = $actualStock - $product->stock;

        // Simpan hasil opname
        $this->opnameRepo->create([
            'product_id' => $productId,
            'actual_stock' => $actualStock,
            'difference' => $difference,
            'user_id' => Auth::id(),
            'note' => $note,
        ]);

        // Update stok jika berbeda
        if ($difference !== 0) {
            $this->productRepo->updateStock($productId, $actualStock);
        }
    }
}
