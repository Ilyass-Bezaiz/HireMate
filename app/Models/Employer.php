<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'companyName',
        'city',
        'zip',
        'country',
        'industry',
        'employeeCount',
        'logo',
        'coverPicture',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}