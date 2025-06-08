<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Vak;

class VakkenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Voeg 9 vakken toe met verschillende producten en hun status
        Vak::create([
            'product_id' => 6,
            'vak_type_id' => 2, 
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 5,
            'vak_type_id' => 2,
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 4,
            'vak_type_id' => 2, 
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 7,  
            'vak_type_id' => 2,
            'status' => 'bezet',  
        ]);

        Vak::create([
            'product_id' => 3,
            'vak_type_id' => 2,
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 2,
            'vak_type_id' => 2,
            'status' => 'bezet',  
        ]);

        Vak::create([
            'product_id' => 1,  
            'vak_type_id' => 2,
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 8,  
            'vak_type_id' => 2,
            'status' => 'bezet',
        ]);

        Vak::create([
            'product_id' => 9,
            'vak_type_id' => 1,
            'status' => 'bezet',
        ]);
    }
}
