<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

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
