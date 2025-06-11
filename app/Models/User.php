<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'gebruikers';

    protected $fillable=['naam', 'password', 'role'];

    //Kijk na welke functie/role de gebruiker heeft
    public static function isBeheerder(){
        $gebruiker = Auth::user();
        return $gebruiker->role === 'beheerder';
    }

    public static function isMedewerker(){
        $gebruiker = Auth::user();
        return $gebruiker->role === 'medewerker';
    }

    public static function isKlant(){
        $gebruiker = Auth::user();
        return $gebruiker->role === 'klant';
    }
}
