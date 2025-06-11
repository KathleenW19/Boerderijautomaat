<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GebruikerController extends Controller
{
    
    public function index()
    {
        // Ophalen van de ingelogde gebruiker
        $gebruiker = Auth::user();

        // Controleer of de gebruiker daadwerkelijk ingelogd is
        if ($gebruiker) {
            // Als de gebruiker is ingelogd, geef de gebruiker door aan de view
            return view('boerderijautomaat.index', compact('gebruiker'));
        } else {
            // Als er geen gebruiker is ingelogd, stuur door naar de loginpagina
            return redirect()->route('login.form');
        }
    }


    public function create(){
        return view('welcome');
    }

    public function login(Request $request)
    {
        Log::info('Login attempt', ['username' => $request->uname]);

        // Check of velden ingevuld zijn
        if (empty($request->uname) || empty($request->pwd)) {
            return redirect()->route('login.form')->with('error', 'Alle velden moeten ingevuld worden.');
        }

        // Validatie
        $request->validate([
            'uname' => 'required|string|max:255',
            'pwd' => 'required|string|min:8',
        ]);

        // Gebruiker ophalen
        $user = User::where('naam', $request->uname)->first();

        if (!$user) {
            Log::warning('Gebruiker niet gevonden', ['input' => $request->uname]);
            return redirect()->route('login.form')->with('error', 'Gebruiker niet gevonden');
        }

        // Debug info loggen
        /*Log::info('Login debug info', [
            'ingevoerde_username' => $request->uname,
            'ingevoerde_wachtwoord' => $request->pwd,
            'gehashte_wachtwoord_uit_db' => $user->password,
            'hash_check' => Hash::check($request->pwd, $user->password),
            'verwacht_plaintext' => 'KlantWachtwoord',
            'klopt_met_test_waarde' => Hash::check('KlantWachtwoord', $user->password),
            'wachtwoord_exact_gelijk_aan_test' => $request->pwd === 'KlantWachtwoord',
        ]);*/

        // Controleer wachtwoord
        if (!Hash::check($request->pwd, $user->password)) {
            return redirect()->route('login.form')->with('error', 'Gebruikersnaam of wachtwoord is incorrect.');
        }

        // Log gebruiker in
        Auth::login($user);

        return redirect()->route('boerderijautomaat.index');
    }

    // Gebruiker uit loggen en terug naar login pagina sturen
    public function logout(){
        Auth::logout();
        return redirect()->route('login.form');
    }
}
