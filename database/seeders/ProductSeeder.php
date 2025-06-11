<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Voeg producten toe
        Product::insert([
            ['product_naam' => '6 Eieren', 'categorie_id' => 1, 'prijs' => 2.50, 'afbeelding_met_product' => '/Images/6-eieren.jpg'],
            ['product_naam' => '12 Eieren', 'categorie_id' => 1, 'prijs' => 4.50, 'afbeelding_met_product' => '/Images/12-eieren.jpg'],
            ['product_naam' => 'Aardbeien', 'categorie_id' => 2, 'prijs' => 3.00, 'afbeelding_met_product' => '/Images/Aardbeien.jpg'],
            ['product_naam' => 'Appelen', 'categorie_id' => 2, 'prijs' => 2.00, 'afbeelding_met_product' => '/Images/appelen.jpg'],
            ['product_naam' => 'Bloemkool', 'categorie_id' => 3, 'prijs' => 1.80, 'afbeelding_met_product' => '/Images/bloemkool.jpg'],
            ['product_naam' => 'Rodekool', 'categorie_id' => 3, 'prijs' => 1.60, 'afbeelding_met_product' => '/Images/rodekool.jpg'],
            ['product_naam' => 'Peren', 'categorie_id' => 3, 'prijs' => 2.50, 'afbeelding_met_product' => '/Images/peren.jpg'],
            ['product_naam' => '1kg Aardappelen', 'categorie_id' => 4, 'prijs' => 1.00, 'afbeelding_met_product' => '/Images/1kgAardappelen.jpg'],
            ['product_naam' => '5kg Aardappelen', 'categorie_id' => 4, 'prijs' => 4.00, 'afbeelding_met_product' => '/Images/5kgAardappelen.jpg',]
        ]);
    }
}
