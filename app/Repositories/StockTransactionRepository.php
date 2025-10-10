<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    public function getAll()
    {
        return StockTransaction::with(['product', 'user'])->latest()->get();
    }
}
