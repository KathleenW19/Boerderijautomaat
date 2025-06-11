<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Vak;
use App\Models\Product;
use App\Models\Voorraad;
use Illuminate\Http\Request;

class VakController extends Controller
{
    public function index()
    {
        // Haal alle vakken uit de database
        $gebruiker = Auth::user();
        $vakken = Vak::all();
        $producten= Product::all();

        // Retourneer de view met de vakken data
        return view('boerderijautomaat.index', compact('gebruiker', 'vakken', 'producten'));
    }

    public function checkVak(Request $request)
    {
        $vaknummer = $request->input('vaknummer');
        $vak = Vak::find($vaknummer);

        // Controleer of het vak bestaat en of het niet leeg is
        if ($vak) {
            if ($vak->status === 'leeg') {
                session()->forget('gekozen_vak');
                return redirect()->route('boerderijautomaat.index')->with('error', 'Dit vak is leeg, geen product om te kopen.');
            } else {
                session(['gekozen_vak' => $vaknummer]);
                return redirect()->route('boerderijautomaat.index');
            }
        } else {
            session()->forget('gekozen_vak'); // <- voeg deze regel toe
            return redirect()->route('boerderijautomaat.index')->with('error', 'Ongeldig vaknummer.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $vak = Vak::find($id);

        if ($vak) {
            $nieuweStatus = $request->input('status');

            if ($nieuweStatus === 'vak geopend' || $nieuweStatus === 'leeg' || $nieuweStatus === 'bezet') {
                $vak->status = $nieuweStatus;

                if ($nieuweStatus === 'leeg') {
                    if ($vak->product_id) {
                        // Voeg het product weer toe aan de voorraad
                        $voorraad = Voorraad::where('product_id', $vak->product_id)->first();

                        $vak->product_id = null;
                    }
                }

                $vak->save();
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['error' => 'Vak niet gevonden of ongeldige status'], 404);
    }
}
