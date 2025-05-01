<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Vak;
use App\Models\ProductCategorie;
use App\Models\Voorraad;
use Illuminate\Http\Request;

class VoorraadController extends Controller
{
    public function index()
    {
        $vakken = Vak::with('product')->get();
        $producten = Product::with('voorraad', 'categorie')->get();

        return view('voorraad.index', compact('vakken', 'producten'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categorieen = ProductCategorie::all();
        return view('voorraad.edit', compact('product', 'categorieen'));
    }

    public function updateProduct(Request $request, $id){
        //dd($request->all());
        //Valideer form gegevens
        $validatedData = $request->validate([
            'productname' => 'required|string|max:255',
            'prijs' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:product_categorie,id',
            'voorraad' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        //Gegevens bijwerken
        $product->product_naam = $validatedData['productname'];
        $product->prijs = $validatedData['prijs'];
        $product->categorie_id = $validatedData['categorie_id'];
        
        //Voorraad bijwerken
        $voorraad = Voorraad::where('product_id', $id)->first();
        if($voorraad){
            $voorraad->aantal = $validatedData['voorraad'];
            $voorraad->save(); //voorraad opslaan
        }

        $product->save(); //product opslaan 

        return redirect()->route('voorraad.index')->with('succes', 'Product succesvol bijgewerkt!');
    }
}
