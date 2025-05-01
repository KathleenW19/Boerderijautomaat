<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategorie;
use App\Models\Product;
use App\Models\Voorraad;

class VoorraadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Voeg voorraad toe
        Voorraad::create(['product_id' => '1', 'aantal' => 2]);
        Voorraad::create(['product_id' => '2', 'aantal' => 2]);
        Voorraad::create(['product_id' => '3', 'aantal' => 2]);
        Voorraad::create(['product_id' => '4', 'aantal' => 2]);
        Voorraad::create(['product_id' => '5', 'aantal' => 2]);
        Voorraad::create(['product_id' => '6', 'aantal' => 2]);
        Voorraad::create(['product_id' => '7', 'aantal' => 2]);
        Voorraad::create(['product_id' => '8', 'aantal' => 2]);
        Voorraad::create(['product_id' => '9', 'aantal' => 2]);
    }
}
