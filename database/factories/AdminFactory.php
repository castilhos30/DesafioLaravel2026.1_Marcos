<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AdminFactory extends Factory
{
    
    protected $model = User::class; 

    public function definition(): array
    {
        return [
            'name' => fake()->name() . ' (Admin)',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'cpf' => fake()->unique()->numerify('###########'),
            'telefone' => fake()->numerify('###########'),
            'data_nascimento' => fake()->dateTimeBetween('-50 years', '-20 years')->format('Y-m-d'),
            'saldo' => 0,
            'criado_por' => null,
        ];
    }
}