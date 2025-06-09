<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategorie;

class ProductCategorieController extends Controller
{
    public function index()
    {
        $categorieen = ProductCategorie::all();

        return view('productcategorie.index', compact('categorieen'));
    }

    public function create()
    {
        return view('productcategorie.create');
    }

    public function edit($id)
    {
        $categorie = ProductCategorie::findOrFail($id);
        return view('productcategorie.edit', compact('categorie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        ProductCategorie::create($request->all());

        return redirect()->route('productcategorie.index')->with('success', 'Productcategorie succesvol aangemaakt.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        $categorie = ProductCategorie::findOrFail($id);
        $categorie->update($request->all());

        return redirect()->route('productcategorie.index')->with('success', 'Productcategorie succesvol bijgewerkt.');
    }

    public function delete($id)
    {
        $categorie = ProductCategorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('productcategorie.index')->with('success', 'Productcategorie succesvol verwijderd.');
    }
}
