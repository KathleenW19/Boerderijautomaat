<?php
namespace App\Http\Controllers;

use App\Models\VerkoopTransactie;
use App\Models\VerkochteProducten;
use App\Models\Product;
use Illuminate\Http\Request;

class VerkoopTransactieController extends Controller
{
    public function index()
    {
        $transacties = VerkoopTransactie::with('verkochteProducten')->get();
        return view('transactie.index', compact('transacties'));
    }

    public function store(Request $request)
    {
        // Validatie
        $data = $request->validate([
            'product_id' => 'required|exists:producten,id',
            'aantal' => 'required|integer|min:1', 
            'betaal_methode' => 'required|in:contant,contactloos',
        ]);

        $product = Product::find($data['product_id']);

        // Bereken het totaalbedrag voor de transactie
        $totaalbedrag = $product->prijs * $data['aantal'];

        // Maak een nieuwe verkooptransactie aan
        $transactie = new VerkoopTransactie();
        $transactie->betaal_methode = $data['betaal_methode'];
        $transactie->totaalbedrag = $totaalbedrag;
        $transactie->save();  // Transactie opslaan

        // data opslaan in verkochte_producten
        $verkochteProduct = new VerkochteProducten();
        $verkochteProduct->transactie_id = $transactie->id;
        $verkochteProduct->product_id = $data['product_id'];
        $verkochteProduct->aantal = $data['aantal'];
        $verkochteProduct->save();

        return response()->json(['success' => true, 'transactie_id' => $transactie->id]);
    }
}