<?php

namespace Database\Seeders;

use App\Models\VakType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VakTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VakType::insert([
            ['naam' => 'Gekoeld'],
            ['naam' => 'Ongekoeld'],
            ['naam' => 'Vriesvak'],
        ]);
    }
}
