<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'education_level',
        'education_status',
        'education_field',
        'start_date',
        'end_date',
        'user_id'
    ];
    use HasFactory;
}
