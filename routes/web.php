<?php

use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\VakController;
use App\Http\Controllers\VerkoopTransactieController;
use App\Models\VerkoopTransactie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Login routes
Route::post('/login', [GebruikerController::class, 'login'])->name('login');
Route::get('/login', [GebruikerController::class, 'create'])->name('login.form');

// Route na inloggen (beveiligd met auth middleware)
Route::middleware(['auth'])->get('/boerderijautomaat', [VakController::class, 'index'])->name('boerderijautomaat.index');

// Logout route
Route::post('/logout', [GebruikerController::class, 'logout'])->name('logout');

// Voorraad route
Route::middleware(['auth'])->get('/voorraad', [VoorraadController::class, 'index'])->name('voorraad.index');
    // Bewerken
    Route::get('/producten/edit/{id}', [VoorraadController::class, 'edit'])->name('producten.edit');
    Route::put('/producten/edit/{id}', [VoorraadController::class, 'updateProduct']) -> name('voorraad.update');
    Route::delete('/voorraad/{id}', [VoorraadController::class, 'delete'])->name('voorraad.delete');
    Route::get('/producten/create', [VoorraadController::class, 'create'])->name('producten.create');

// Vakken route
Route::post('/bijvullen', [VakController::class, 'bijvullen'])->name('bijvullen');
Route::post('/vak/controleer', [VakController::class, 'checkVak'])->name('vak.controleer');
Route::post('/vak/betaal', [VakController::class, 'betaal'])->name('vak.betaal');
Route::post('/vak/{id}/update-status', [VakController::class, 'updateStatus']);
Route::get('/api/product/{id}/deur_afbeelding', function($id) {
    $product = \App\Models\Product::findOrFail($id);
    return response()->json([
        'deur_afbeelding_url' => asset($product->deur_afbeelding)
    ]);
});

//Transactie route
Route::middleware(['auth'])-> get('/transactie', [VerkoopTransactieController::class, 'index'])->name('transactie.index');
Route::post('/transactie', [VerkoopTransactieController::class, 'store'])->name('transactie.store');


