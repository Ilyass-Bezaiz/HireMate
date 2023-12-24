<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skills',
        'age',
        'gender',
        'workExperience',
        'education',
        'curriculumVitae',
        'backgroundColor',
        'textColor',
        'fontFamily',
        'profilePicture',
        'coverPicture',
        'coverLetter',
        'jobPreferences',
    ];

    protected $casts = [
        'skills' => 'json', // Cast the 'skills' attribute to JSON
        'workExperience'=> 'json',
        'education' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}