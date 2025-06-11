<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VakType extends Model
{
    protected $fillable = ['naam'];

    public function vakken()
    {
        return $this->hasMany(Vak::class);
    }
}
