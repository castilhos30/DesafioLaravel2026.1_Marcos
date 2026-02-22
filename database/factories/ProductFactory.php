<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {

    $nomesMotos = [
        'Capacete LS2 Rapid', 
        'Pneu Michelin Pilot Street', 
        'Óleo Motul 5100 4T', 
        'Pastilha de Freio Brembo',
        'Kit Transmissão DID',
        'Luva Alpinestars Spartan',
        'Retrovisor Rizoma Stealth'
    ];

     $fotosMotos = [
        'moto1.jpg',
        'moto2.png',
        'moto4.jpg',
        'moto5.jpg',
        'moto7.jpg',
        'moto8.png',
    ];

    $nomeSelecionado = $this->faker->randomElement($nomesMotos);
        $fotoSelecionada = $this->faker->randomElement($fotosMotos);
        return [
            'nome' => $nomeSelecionado, 
            'descricao' => fake()->sentence(),
            'categorias' => fake()->randomElement(['Acessório', 'Peça', 'Ferramenta', 'Outros']),
            'preco' => fake()->randomFloat(2, 10, 1000), 
            'quantidade' => fake()->numberBetween(1, 50),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(), 
           'foto' => $fotoSelecionada, 
            
            'created_at' => fake()->dateTimeBetween('-11 months', 'now'), 
        ];
    }
}