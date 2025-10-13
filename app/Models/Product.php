<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * Izinkan mass assignment untuk field yang digunakan di form/store/update.
     */
    protected $fillable = [
        'name','sku','category_id','supplier_id','price','stock','description','image','attributes'
    ];

    // tambahkan cast
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Kategori produk (belongsTo)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * Supplier produk (belongsTo)
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }

    /**
     * Helper sederhana: kembalikan nilai atribut yang disimpan di kolom JSON "attributes"
     * atau null bila tidak tersedia.
     */
    public function attributeValue($attributeId)
    {
        if ($this->getAttribute('attributes')) {
            $attrs = is_array($this->attributes['attributes'] ?? null)
                ? $this->attributes['attributes']
                : json_decode($this->attributes['attributes'], true) ?? [];
            return $attrs[$attributeId] ?? null;
        }

        return null;
    }
}
