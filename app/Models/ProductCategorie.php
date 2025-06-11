<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductCategorie extends Model
{
    protected $table = 'product_categorie';
    public $timestamps = false;
    protected $fillable=['naam'];

    public function producten(){
        return $this->hasMany(Product::class, 'categorie_id');
    }
}
