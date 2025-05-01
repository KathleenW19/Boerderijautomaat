<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategorie;
use App\Models\Product;
use App\Models\Voorraad;

class ProductCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Voeg categorieën toe via Eloquent
        ProductCategorie::create(['naam' => 'Eieren']);
        ProductCategorie::create(['naam' => 'Fruit']);
        ProductCategorie::create(['naam' => 'Groenten']);
        ProductCategorie::create(['naam' => 'Aardappelen']);

    }
}
