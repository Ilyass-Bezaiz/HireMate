<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    protected $fillable = [
        'id', 'state_id', 'name', 'status'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public static function getCity($cityId) {
        $city = self::where('id', $cityId)->get();
        return $city[0];
    }

    public static function getCityId($cityName) {
        $city = self::where('name', "like","%". $cityName ."%")->get();
        // dd($city[3]->name);
        return $city;
    }
}
