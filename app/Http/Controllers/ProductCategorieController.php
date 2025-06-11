<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategorie;

class ProductCategorieController extends Controller
{
    public function index()
    {
        $categorieen = ProductCategorie::all();

        return view('productCategorie.index', compact('categorieen'));
    }

    public function create()
    {
        return view('productCategorie.create');
    }

    public function edit($id)
    {
        $categorie = ProductCategorie::findOrFail($id);
        return view('productCategorie.edit', compact('categorie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        ProductCategorie::create(['naam' => $request->input('naam')]);

        return redirect()->route('productCategorie.index')->with('success', 'Product categorie succesvol aangemaakt.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        $categorie = ProductCategorie::findOrFail($id);
        $categorie->naam = $request->input('naam');
        $categorie->save();

        return redirect()->route('productCategorie.index')->with('success', 'Product categorie succesvol bijgewerkt.');
    }

    public function delete($id)
    {
        $categorie = ProductCategorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('productCategorie.index')->with('success', 'Product categorie succesvol verwijderd.');
    }
}
