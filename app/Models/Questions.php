<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'categories'; 
    protected $fillable = [
        'category',
        'question',
        'answer',
        'points',
        'bonus',
        'status'
    ];
}
