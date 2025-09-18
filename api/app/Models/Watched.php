<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watched extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'watched_at'
    ];

    protected $casts = [
        'watched_at' => 'datetime',
    ];
}
