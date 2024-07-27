<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizRel extends Model
{
    use HasFactory;

    protected $table = 'user_quiz_rel'; 
    protected $fillable = [
        'user',
        'quiz',
        'relation'
    ];
}
