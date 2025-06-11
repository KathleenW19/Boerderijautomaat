<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Voorraad extends Model
{
    public $timestamps = false;
    protected $table = 'voorraad';
    protected $fillable=['product_id', 'aantal'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
