<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductAttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'name' => fake()->randomElement(['Warna', 'Ukuran', 'Berat']),
            'value' => fake()->randomElement(['Merah', 'Hitam', 'L', '500gr', '1kg']),
        ];
    }

}
