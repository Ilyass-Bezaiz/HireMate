<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLanguages extends Model
{
    protected $fillable = [
        'user_id',
        'language_id',
        'proficiency'
    ];

    use HasFactory;
}
