<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    protected $table = 'vakken';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'vak_type_id', 'status'];

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
        $alt = 'Leeg vak';
        if ($this->status === 'vak geopend') {
            $alt = 'Vak geopend';
        } elseif ($this->status !== 'leeg' && isset($this->product)) {
            $alt = 'Vak met product';
        }
        return $alt;
    }

    public function getOnClickAttribute()
    {
        if ($this->status === 'leeg' || !isset($this->product)) {
            return "chooseVak({$this->id})";
        }

        return "removeProductFromVak({$this->id})";
    }
}
