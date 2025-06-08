<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Vak;
use App\Models\VakType;
use App\Models\Voorraad;
use Illuminate\Http\Request;

class VoorraadController extends Controller
{
    public function index()
    {
        $vakken = Vak::with('product')->get();
        $producten = Product::with('voorraad', 'categorie')->get();

        return view('vakken.index', compact('vakken', 'producten'));
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
            return redirect()->route('vakken.index')->with('error', 'Niet genoeg voorraad voor dit product.');
        }
    }

    public function edit($id){
        $vak = Vak::findOrFail($id);
        $producten = Product::all();
        $vakTypes = VakType::all();

        return view('vakken.edit', compact('vak', 'producten', 'vakTypes'));
    }

    public function updateVak(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:producten,id',
            'vak_type_id' => 'required|exists:vak_types,id',
        ]);

        $vak = Vak::findOrFail($id);
        $nieuwProductId = $request->input('product_id');

        // Als het product hetzelfde is, kan je een info teruggeven
        if ($vak->product_id == $nieuwProductId) {
            return redirect()->route('boerderijautomaat.index')->with('info', 'Dit product staat al in dit vak.');
        }

        // Controleer voorraad van nieuw product
        $voorraadNieuw = Voorraad::where('product_id', $nieuwProductId)->first();
        if (!$voorraadNieuw || $voorraadNieuw->aantal < 1) {
            return redirect()->route('boerderijautomaat.index')->with('error', 'Niet genoeg voorraad voor dit product.');
        }

        // Voorraad terugzetten voor oud product (indien aanwezig)
        if ($vak->product_id) {
            $voorraadOud = Voorraad::where('product_id', $vak->product_id)->first();
            if ($voorraadOud) {
                $voorraadOud->aantal += 1;
                $voorraadOud->save();
            }
        }

        // Vak bijwerken
        $vak-> vak_type_id = $request->input('vak_type_id');
        $vak->product_id = $nieuwProductId;
        $vak->status = 'bezet';
        $vak->save();

        // Verminder voorraad nieuw product
        $voorraadNieuw->aantal -= 1;
        $voorraadNieuw->save();

        return redirect()->route('boerderijautomaat.index')->with('succes', 'Vak succesvol bijgewerkt.');
    }

}
