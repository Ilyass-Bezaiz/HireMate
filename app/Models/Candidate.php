<?php

namespace App\Models;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
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
        'about',
        'headline'
    ];

    protected $casts = [
        'skills' => 'array', // Cast the 'skills' attribute to JSON
        'workExperience'=> 'json',
        'education' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
}