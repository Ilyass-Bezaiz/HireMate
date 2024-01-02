<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [
        'company_name',
        'position',
        'start_date',
        'end_date',
        'responsibilities',
        'user_id'
    ];

    use HasFactory;
}
