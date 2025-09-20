<?php

namespace App\Models;

use App\Traits\HasCover;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory, HasCover;

    protected $fillable = [
        'name',
        'description',
        'cover'
    ];

    public function movies (): BelongsToMany 
    {
        return $this->belongsToMany(Movie::class, 'genre_movie');
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->coverUrl('genres', 'genre-cover.png');
    }
}
