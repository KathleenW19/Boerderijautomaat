<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'producten';
    protected $fillable=['product_naam', 'categorie_id', 'prijs', 'afbeelding_met_product', 'afbeelding_vak_open'];

    public function categorie(){
        return $this->belongsTo(ProductCategorie::class, 'categorie_id');
    }

    public function verkochteProducten(){
        return $this->hasMany(VerkochteProducten::class, 'product_id');
    }

    public function voorraad(){
        return $this->hasMany(Voorraad::class, 'product_id');
    }

    public function vakken(){
        return $this ->hasMany(Vak::class);
    }

    //Prijs wordt behandelt als een decimal
    protected $casts = ['prijs'=> 'decimal:2'];
}
