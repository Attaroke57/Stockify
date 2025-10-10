<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\StockTransaction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        User::factory()->create([
            'name' => 'Admin Stockify',
            'email' => 'admin@stockify.test',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Generate data dummy
        Category::factory(5)->create();
        Supplier::factory(5)->create();
        Product::factory(10)->create()->each(function ($product) {
            ProductAttribute::factory(2)->create(['product_id' => $product->id]);
        });
        StockTransaction::factory(20)->create();
    }
}
