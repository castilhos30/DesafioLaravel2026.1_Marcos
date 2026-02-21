<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->words(3, true), 
            'descricao' => fake()->sentence(),
            'categorias' => fake()->randomElement(['Acessório', 'Peça', 'Ferramenta', 'Outros']),
            'preco' => fake()->randomFloat(2, 10, 1000), 
            'quantidade' => fake()->numberBetween(1, 50),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(), 
            'foto' => 'produtos/default.jpg', 
            
            'created_at' => fake()->dateTimeBetween('-11 months', 'now'), 
        ];
    }
}