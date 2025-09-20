<?php

namespace App\Models;

use App\Traits\HasCover;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory, HasCover;

    protected $fillable = [
        'tmdb_id',
        'title',
        'description',
        'release_date',
        'duration',
        'cover',
        'created_by',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie')->withTimestamps();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(MovieLike::class);
    }

    public function watched(): HasMany 
    {
        return $this->hasMany(Watched::class);
    }

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(MovieList::class, 'list_movies', 'movie_id', 'movie_list_id')->withTimestamps();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->coverUrl('movies', 'movie-cover.png');
    }
}
