<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\StockTransaction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users (Admin, Manager, Staff)
        $this->command->info('Creating users...');

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

        // 2. Seed Categories (menggunakan CategorySeeder)
        $this->command->info('Creating categories...');
        $this->call(CategorySeeder::class);

        // 3. Seed Suppliers (menggunakan SupplierSeeder)
        $this->command->info('Creating suppliers...');
        $this->call(SupplierSeeder::class);

        // 4. Seed Products with Attributes
        $this->command->info('Creating products with attributes...');
        Product::factory(50)->create()->each(function ($product) {
            // Create 2 attributes for each product (optional)
            ProductAttribute::factory(2)->create(['product_id' => $product->id]);
        });

        // 5. Seed Stock Transactions
        $this->command->info('Creating stock transactions...');
        StockTransaction::factory(30)->create();

        $this->command->info('✅ Database seeding completed successfully!');
    }
}
