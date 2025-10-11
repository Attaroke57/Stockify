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
        // 🔹 Admin
        User::factory()->create([
            'name' => 'Purnomo Admin Stockify',
            'email' => 'admin@stockify.test',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 🔹 Manajer Gudang
        User::factory()->create([
            'name' => 'Budi Manajer Gudang',
            'email' => 'manager@stockify.test',
            'role' => 'manager',
            'password' => bcrypt('password'),
        ]);

        // 🔹 Staff Gudang
        User::factory()->create([
            'name' => 'Siti Staff Gudang',
            'email' => 'staff@stockify.test',
            'role' => 'staff',
            'password' => bcrypt('password'),
        ]);

        // 🔹 Tambahan data dummy user lainnya (optional)
        User::factory(5)->create();

        // Generate data dummy
        Category::factory(5)->create();
        Supplier::factory(5)->create();
        Product::factory(10)->create()->each(function ($product) {
            ProductAttribute::factory(2)->create(['product_id' => $product->id]);
        });
        StockTransaction::factory(20)->create();
    }
}
