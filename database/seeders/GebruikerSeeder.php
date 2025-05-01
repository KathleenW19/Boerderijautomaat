<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'naam' => 'Klant',
            'password' => Hash::make('KlantWachtwoord'),
            'role' => 'klant',
        ]);

        User::create([
            'naam' => 'Beheerder',
            'password' => Hash::make('BeheerderWachtwoord'),
            'role' => 'beheerder',
        ]);

        User::create([
            'naam' => 'Medewerker',
            'password' => Hash::make('MedewerkerWachtwoord'),
            'role' => 'medewerker',
        ]);
    }
}
