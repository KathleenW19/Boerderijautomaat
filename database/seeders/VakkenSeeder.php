<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Vak;

class VakkenSeeder extends Seeder
{
    public function run(): void
    {
        // Voegt 9 vakken toe met verschillende producten en hun status
        Vak::insert([
            ['product_id' => 6, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 5, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 4, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 7, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 3, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 2, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 1, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 8, 'vak_type_id' => 2, 'status' => 'bezet'],
            ['product_id' => 9, 'vak_type_id' => 1, 'status' => 'bezet'],
        ]);
    }
}