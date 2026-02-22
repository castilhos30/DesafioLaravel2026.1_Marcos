<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Hash;
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
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);


        User::factory(10)->create();
        Product::factory(30)->create();
        Sale::factory(50)->create();
        Sale::factory(10)->create([
            'vendedor_id' => 1 
        ]);
    }
}
