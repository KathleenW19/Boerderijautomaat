<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Voorraad;

class VoorraadSeeder extends Seeder
{
    public function run(): void
    {
        // Voeg voorraad toe
        Voorraad::insert([
            ['product_id' => 1, 'aantal' => 2],
            ['product_id' => 2, 'aantal' => 2],
            ['product_id' => 3, 'aantal' => 2],
            ['product_id' => 4, 'aantal' => 2],
            ['product_id' => 5, 'aantal' => 2],
            ['product_id' => 6, 'aantal' => 2],
            ['product_id' => 7, 'aantal' => 2],
            ['product_id' => 8, 'aantal' => 2],
            ['product_id' => 9, 'aantal' => 2],
        ]);
    }
}
