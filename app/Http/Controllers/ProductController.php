<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategorie;
use App\Models\Voorraad;

class ProductController extends Controller
{
    public function index()
    {
        $producten = Product::with('categorie')->get();
        return view('producten.index', compact('producten'));
    }

    public function create()
    {
        $categorieen = ProductCategorie::all();
        return view('producten.create', compact('categorieen'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categorieen = ProductCategorie::all();
        return view('producten.edit', compact('product', 'categorieen'));
    }

    public function updateProduct(Request $request, $id){
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

        return redirect()->route('producten.index')->with('succes', 'Product succesvol bijgewerkt!');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        
        foreach ($product->vakken as $vak) {
            $vak->update([
                'product_id' => null,
                'status' => 'leeg',
            ]);
        }

        $product->delete(); //Product verwijderen
        return redirect()->route('producten.index')->with('succes', 'Product succesvol verwijderd!');
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

        return redirect()->route('producten.index')->with('succes', 'Product succesvol aangemaakt!');
    }
}