<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    // Geef de naam van de tabel aan als het niet het meervoud van de modelnaam is
    protected $table = 'vakken';
    protected $primaryKey = 'id';

    // Geef de vulbare velden aan
    protected $fillable = ['product_id', 'vak_type_id', 'status'];

    // Relatie naar het Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vakType()
    {
        return $this->belongsTo(VakType::class);
    }

    public function getAfbeeldingSrcAttribute()
    {
        if ($this->status === 'vak geopend' && isset($this->product)) {
            // Product afbeelding op de achtergrond en deur op de voorgrond
            return asset($this->product->afbeelding_met_product); // De productafbeelding
        } elseif ($this->status === 'leeg' || !isset($this->product)) {
            // Als leeg, toon deur met lege status
            return asset($this->product ? $this->product->deur_afbeelding : 'images/deur_dicht.png');
        }

        // Als het vak bezet is, toon deur met product zichtbaar erachter
        return asset($this->product->afbeelding_met_product);
    }

    public function getAltTextAttribute()
    {
        if ($this->status === 'leeg') {
            return 'Leeg vak';
        } elseif ($this->status === 'vak geopend') {
            return 'Vak geopend';
        } elseif (isset($this->product)) {
            return 'Vak met product';
        }

        return 'Leeg vak';
    }

    public function getOnClickAttribute()
    {
        if ($this->status === 'leeg' || !isset($this->product)) {
            return "chooseVak({$this->id})";
        }

        return "removeProductFromVak({$this->id})";
    }

}
