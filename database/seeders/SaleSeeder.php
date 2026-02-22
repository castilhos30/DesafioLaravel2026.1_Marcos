<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
       
        Sale::factory(50)->create();
        Sale::factory(10)->create([
            'vendedor_id' => 1 
        ]);
    }
}