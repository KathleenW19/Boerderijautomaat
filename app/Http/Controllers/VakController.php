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

    public function bijvullen(Request $request)
    {
        // Haal het vak en het product op via de request
        $vakId = $request->input('vak_id');
        $productId = $request->input('product_id');

        // Haal het vak en het product op
        $vak = Vak::findOrFail($vakId);
        $product = Product::findOrFail($productId);

        // Haal de voorraad van het product op
        $voorraad = Voorraad::where('product_id', $product->id)->first();

        // Controleer of er voldoende voorraad is
        if ($voorraad && $voorraad->aantal > 0) {
            // Koppel het product aan het vak
            $vak->product_id = $product->id;
            $vak->status = 'bezet';  // Markeer het vak als bezet
            $vak->save();

            // Verminder de voorraad met 1
            $voorraad->aantal -= 1;
            $voorraad->save();

            // Redirect terug naar de pagina van de vakken
            return redirect()->route('boerderijautomaat.index');
        } else {
            // Als er geen voorraad is, geef een foutmelding en stuur de gebruiker naar de voorraad pagina
            return redirect()->route('voorraad.index')->with('error', 'Niet genoeg voorraad voor dit product.');
        }
    }

    public function checkVak(Request $request)
    {
        $vaknummer = $request->input('vaknummer');
        $vak = Vak::find($vaknummer);

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
