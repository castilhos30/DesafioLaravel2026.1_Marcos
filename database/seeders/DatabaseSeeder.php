<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Hash;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            AdminSeeder::class,
        ]);

        

        User::factory()->create([
            'name' => 'Test Admin', 
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);


    }
}