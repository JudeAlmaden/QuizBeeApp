<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_quiz_rel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'quiz',
        'relation'
    ];
}
