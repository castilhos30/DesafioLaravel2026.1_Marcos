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
        $nomesAdmin = [
            'Marcos César', 
            'Bruno', 
            'Miguel', 
            'Mickaell',
            'Délio',
            'Lucas',
            'Rafael',
            'Marcos',
            'Breno',
            'Bernado',
        ];

         $fotosAdmin = [
        'user1.jpg',
        'user2.jpg',
        'user3.jpg',
        'user4.jpg',
        'user5.jpg',
        'user6.jpg',
    ];
        $nomeSelecionado = $this->faker->randomElement($nomesAdmin);
        $fotoSelecionada = $this->faker->randomElement($fotosAdmin);
        return [
            'name' => $nomeSelecionado . ' (Admin)',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'foto' => $fotoSelecionada,
            'cpf' => fake()->unique()->numerify('###########'),
            'telefone' => fake()->numerify('329########'),
            'data_nascimento' => fake()->dateTimeBetween('-50 years', '-20 years')->format('Y-m-d'),
            'saldo' => 0,
            'criado_por' => null,
        ];
    }
}