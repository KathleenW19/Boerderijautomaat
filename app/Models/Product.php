<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'producten';
    protected $fillable=['product_naam', 'categorie_id', 'prijs', 'afbeelding_met_product'];
    //Prijs wordt behandelt als een decimal
    protected $casts = ['prijs'=> 'decimal:2'];

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

    public function getProductAfbeeldingUrlAttribute()
    {
        return asset('images/' . $this->product_afbeelding);
    }

    public function getDeurAfbeeldingUrlAttribute()
    {
        return asset('images/deur_dicht.png');
    }
}
