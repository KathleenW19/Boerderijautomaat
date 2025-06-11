<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VerkochteProducten extends Model
{
    public $timestamps = false;
    protected $table = 'verkochte_producten';
    protected $fillable=['transactie_id', 'product_id', 'aantal'];

    public function transactie(){
        return $this->belongsTo(VerkoopTransactie::class, 'transactie_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
