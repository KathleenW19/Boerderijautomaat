<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerkoopTransactie extends Model
{
    public $timestamps = false;
    protected $table = 'verkooptransactie';
    protected $fillable=['totaalbedrag', 'betaal_methode', 'transactie_tijd'];

    public function verkochteProducten(){
        return $this->hasMany(VerkochteProducten::class, 'transactie_id');
    }
}
