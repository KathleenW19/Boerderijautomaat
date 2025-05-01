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
            'product_id' => 6,  // Verwijst naar product met id 1 (bijv. 6 Eieren)
            'status' => 'bezet',  // Dit vak is bezet
        ]);

        Vak::create([
            'product_id' => 5,  // Verwijst naar product met id 2 (bijv. 12 Eieren)
            'status' => 'bezet',  // Dit vak is leeg
        ]);

        Vak::create([
            'product_id' => 4,  // Verwijst naar product met id 3 (bijv. Aardbeien)
            'status' => 'bezet',  // Dit vak is bezet
        ]);

        Vak::create([
            'product_id' => 7,  // Verwijst naar product met id 4 (bijv. Appelen)
            'status' => 'bezet',  // Dit vak is leeg
        ]);

        Vak::create([
            'product_id' => 3,  // Verwijst naar product met id 5 (bijv. Bloemkool)
            'status' => 'bezet',  // Dit vak is bezet
        ]);

        Vak::create([
            'product_id' => 2,  // Verwijst naar product met id 6 (bijv. Rodekool)
            'status' => 'bezet',  // Dit vak is leeg
        ]);

        Vak::create([
            'product_id' => 1,  // Verwijst naar product met id 7 (bijv. Peren)
            'status' => 'bezet',  // Dit vak is bezet
        ]);

        Vak::create([
            'product_id' => 8,  // Verwijst naar product met id 8 (bijv. 1kg Aardappelen)
            'status' => 'bezet',  // Dit vak is leeg
        ]);

        Vak::create([
            'product_id' => 9,  // Verwijst naar product met id 9 (bijv. 5kg Aardappelen)
            'status' => 'bezet',  // Dit vak is bezet
        ]);
    }
}
