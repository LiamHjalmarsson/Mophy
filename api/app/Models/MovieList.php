<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'cover',
        'is_public'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'list_movies', 'movie_list_id', 'movie_id')->withTimestamps();
    }
}
