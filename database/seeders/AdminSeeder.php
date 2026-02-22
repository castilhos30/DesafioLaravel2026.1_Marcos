<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\AdminFactory;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        AdminFactory::new()->count(9)->create();
    }
}