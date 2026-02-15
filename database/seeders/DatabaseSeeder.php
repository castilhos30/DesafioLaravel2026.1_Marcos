<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        Product::create([
            'user_id' => $user->id,
            'nome' => 'Kit Turbo Garrett GT35',
            'descricao' => 'Kit turbo completo para alta performance.',
            'preco' => 3990.00,
            'quantidade' => 5,
            'categorias' => 'Peça', 
            'foto' => null
        ]);
    }
}
