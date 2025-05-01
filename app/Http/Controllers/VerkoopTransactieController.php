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
        // Get all transactions with their related products
        $transacties = VerkoopTransactie::with('verkochteProducten')->get();

        // Return the view with the 'transacties' data passed to it
        return view('transactie.index', compact('transacties'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $data = $request->validate([
            'product_id' => 'required|exists:producten,id',  // Ensure the product exists
            'aantal' => 'required|integer|min:1',            // Ensure the amount is an integer and at least 1
            'betaal_methode' => 'required|in:contant,contactloos',  // Ensure the payment method is either cash or contactless
        ]);

        // Find the product by its ID
        $product = Product::find($data['product_id']);

        // Calculate the total amount for the transaction
        $totaalbedrag = $product->prijs * $data['aantal'];

        // Create a new sale transaction in the VerkoopTransactie table
        $transactie = new VerkoopTransactie();
        $transactie->betaal_methode = $data['betaal_methode'];
        $transactie->totaalbedrag = $totaalbedrag;
        $transactie->save();  // Save the transaction in the database

        // Create a record in the 'verkochte_producten' table for the current transaction
        $verkochteProduct = new VerkochteProducten();
        $verkochteProduct->transactie_id = $transactie->id; // Link to the newly created transactie
        $verkochteProduct->product_id = $data['product_id']; // Save the selected product ID
        $verkochteProduct->aantal = $data['aantal']; // Save the quantity
        $verkochteProduct->save();  // Save the sold product in the 'verkochte_producten' table

        // Return to the transaction index page or wherever needed
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'transactie_id' => $transactie->id]);
        }
    
        return redirect()->route('transactie.index');
    }

}