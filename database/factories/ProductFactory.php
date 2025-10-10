<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Supplier;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'supplier_id' => Supplier::inRandomOrder()->first()->id ?? Supplier::factory(),
            'name' => ucfirst(fake()->words(2, true)),
            'sku' => strtoupper(fake()->bothify('SKU-###??')),
            'description' => fake()->paragraph(),
            'purchase_price' => fake()->randomFloat(2, 5000, 500000),
            'selling_price' => fake()->randomFloat(2, 6000, 600000),
            'image' => fake()->imageUrl(400, 400, 'product', true),
            'minimum_stock' => fake()->numberBetween(1, 10),
            'created_at' => now(),
        ];
    }
}
