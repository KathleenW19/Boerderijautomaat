<?php

use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VakController;
use App\Http\Controllers\VerkoopTransactieController;
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

// Voorraad vakken route
Route::middleware(['auth'])->get('/vakken', [VoorraadController::class, 'index'])->name('vakken.index');
    Route::post('/bijvullen', [VoorraadController::class, 'bijvullen'])->name('vakken.bijvullen');
    Route::get('/vakken/edit/{id}', [VoorraadController::class, 'edit'])->name('vakken.edit');
    Route::put('/vakken/edit/{id}', [VoorraadController::class, 'updateVak']) -> name('vakken.update');
    Route::put('/vakken/{vak}/leegmaken', [VoorraadController::class, 'emptyVak'])->name('vakken.empty');
    
//Voorraad producten route
Route::middleware(['auth'])->get('/producten', [ProductController::class, 'index'])->name('producten.index');
    Route::get('/producten/create', [ProductController::class, 'create'])->name('producten.create');
    Route::post('/producten/store', [ProductController::class, 'store'])->name('producten.store');
    Route::get('/producten/edit/{id}', [ProductController::class, 'edit'])->name('producten.edit');
    Route::put('/producten/edit/{id}', [ProductController::class, 'updateProduct']) -> name('producten.update');
    Route::delete('/voorraad/{id}', [ProductController::class, 'delete'])->name('producten.delete');


// Vakken route
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


