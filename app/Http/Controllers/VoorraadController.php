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

    
}
