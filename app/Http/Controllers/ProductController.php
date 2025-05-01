<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
{
    // Validatie van de gegevens, inclusief de drie afbeeldingen
    $request->validate([
        'product_naam' => 'required|string|max:255',
        'categorie_id' => 'required|exists:product_categorie,id',
        'prijs' => 'required|numeric',
        'afbeelding_met_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'afbeelding_vak_open' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
    $afbeeldingVakMetProduct = null;
    if ($request->hasFile('afbeelding_met_product')) {
        $afbeeldingVakMetProduct = $request->file('afbeelding_met_product')->store('product_images', 'public');
    }

    $afbeeldingVakMetProductDeurOpen = null;
    if ($request->hasFile('afbeelding_vak_open')) {
        $afbeeldingVakMetProductDeurOpen = $request->file('afbeelding_vak_open')->store('product_images', 'public');
    }

    // Het nieuwe product aanmaken
    $product = Product::create([
        'product_naam' => $request->product_naam,
        'categorie_id' => $request->categorie_id,
        'prijs' => $request->prijs,
        'afbeelding_met_product' => $afbeeldingVakMetProduct,
        'afbeelding_vak_open' => $afbeeldingVakMetProductDeurOpen,
    ]);

    return redirect()->route('voorraad.index');
}

}
