<?php

namespace App\Actions\Movie\Rating;

use App\Models\Movie;
use App\Models\Rating;

class DestroyAction
{
    public function __invoke(int $userId, Movie $movie): bool
    {
        $query = Rating::where('user_id', $userId);

        $query->where('movie_id', $movie->id);

        $rating = $query->delete();

        return (bool) $rating;
    }
}
