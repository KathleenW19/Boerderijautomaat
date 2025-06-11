<?php

namespace Database\Seeders;
use App\Models\VakType;
use Illuminate\Database\Seeder;

class VakTypeSeeder extends Seeder
{
    public function run(): void
    {
        VakType::insert([
            ['naam' => 'Gekoeld'],
            ['naam' => 'Ongekoeld'],
            ['naam' => 'Vriesvak'],
        ]);
    }
}
