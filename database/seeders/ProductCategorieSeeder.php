<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ProductCategorie;

class ProductCategorieSeeder extends Seeder
{
    public function run(): void
    {
        ProductCategorie::insert([
            ['naam' => 'Eieren'],
            ['naam' => 'Fruit'],
            ['naam' => 'Groenten'],
            ['naam' => 'Aardappelen'],
        ]);
    }
}
