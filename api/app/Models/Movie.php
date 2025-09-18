<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'description',
        'release_date',
        'duration',
        'cover',
        'created_by',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(MovieLike::class);
    }

    public function watched(): HasMany 
    {
        return $this->hasMany(Watched::class);
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->cover ? asset('storage/movie' . $this->cover) : asset('storage/defaults/movie-cover.png');
    }
}
