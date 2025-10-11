<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
        /** @use HasFactory<\Database\Factories\StockTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'type',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
