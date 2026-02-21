<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'comprador_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'vendedor_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'valor' => fake()->randomFloat(2, 20, 2000),
            'created_at' => fake()->dateTimeBetween('-11 months', 'now'),
        ];
    }
}