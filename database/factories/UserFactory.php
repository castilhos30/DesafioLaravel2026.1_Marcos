<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomesUser = [
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

     $fotosuser = [
        'user1.jpg',
        'user2.jpg',
        'user3.jpg',
        'user4.jpg',
        'user5.jpg',
        'user6.jpg',
    ];

    $nomeSelecionado = $this->faker->randomElement($nomesUser);
        $fotoSelecionada = $this->faker->randomElement($fotosuser);
        return [
            'name' =>  $nomeSelecionado,
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'is_admin' => 0,
            'foto' => $fotoSelecionada,
            'cpf' => fake()->unique()->numerify('###########'),
            'telefone' => fake()->numerify('###########'),
            'data_nascimento' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'saldo' => fake()->randomFloat(2, 0, 5000),
            'criado_por' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
