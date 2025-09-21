<?php

namespace App\Actions\Movie\Rating;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class DestroyAction
{
    public function __invoke(Movie $movie): bool
    {
        $query = Rating::where('user_id', Auth::id());

        $query->where('movie_id', $movie->id);

        $rating = $query->first();

        if(!$rating) {
            return false;
        }

        return (bool) $rating->delete();
    }
}
