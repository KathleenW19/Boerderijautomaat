<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategorie;
use App\Models\Voorraad;

class ProductController extends Controller
{
        public function create()
    {
        $categorieen = ProductCategorie::all();
        return view('producten.create', compact('categorieen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_naam' => 'required|string|max:255',
            'categorie_id' => 'required|exists:product_categorie,id',
            'prijs' => 'required|numeric',
            'afbeelding_met_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Afbeelding opslaan
        $pad = $request->file('afbeelding_met_product')->store('images', 'public');

        $product = Product::create([
            'product_naam' => $request->product_naam,
            'categorie_id' => $request->categorie_id,
            'prijs' => $request->prijs,
            'afbeelding_met_product' => 'storage/' . $pad
        ]);

        Voorraad::create([
            'product_id' => $product->id,
            'aantal' => $request->voorraad,
        ]);

        return redirect()->route('voorraad.index')->with('succes', 'Product succesvol aangemaakt!');
    }
}