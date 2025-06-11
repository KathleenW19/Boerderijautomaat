<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            ['naam' => 'Klant', 'password' => Hash::make('KlantWachtwoord'), 'role' => 'klant'],
            ['naam' => 'Beheerder', 'password' => Hash::make('BeheerderWachtwoord'), 'role' => 'beheerder'],
            ['naam' => 'Medewerker', 'password' => Hash::make('MedewerkerWachtwoord'), 'role' => 'medewerker'],
        ]);
    }
}
