<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
use HasFactory;
    protected $fillable = [
        'id', 'name', 'status'
    ];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function cities(): HasManyThrough
    {
        return $this->hasManyThrough(City::class, State::class);
    }

    public static function getCountry($countryId) {
        $country = self::where('id', $countryId)->get();
        return $country[0];
    }
    public static function getCountryId($countryName) {
        $country = self::where("name", "like","%". $countryName ."%")->get();
        return $country;
    }
    
}
