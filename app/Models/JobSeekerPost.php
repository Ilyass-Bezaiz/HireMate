<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerPost extends Model
{   
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'expected_salary',
        'flexibility',
        'requestedContract',
        'country_id',
        'city_id',
        'user_id'
    ];
}
