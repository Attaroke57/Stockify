<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

class StockTransactionFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['in', 'out']);
        $quantity = fake()->numberBetween(1, 20);

        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'type' => $type,
            'quantity' => $quantity,
            'date' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => 'approved',
            'notes' => ucfirst(fake()->sentence()),
        ];
    }
}
