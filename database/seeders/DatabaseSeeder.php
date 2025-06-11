<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(GebruikerSeeder::class);
        $this->call(ProductCategorieSeeder::class);
        $this->call( ProductSeeder::class);
        $this->call( VoorraadSeeder::class);
        $this->call( VakTypeSeeder::class);
        $this->call( VakkenSeeder::class);
    }
}
