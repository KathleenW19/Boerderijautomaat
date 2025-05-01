<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GebruikerSeeder::class);
        $this->call(ProductCategorieSeeder::class);
        $this->call(class: ProductSeeder::class);
        $this->call(class: VoorraadSeeder::class);
        $this->call(class: VakkenSeeder::class);
    }
}
