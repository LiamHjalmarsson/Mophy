<?php

namespace App\Actions\Movie\Favorite;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class DestroyAction
{
    public function __invoke(Movie $movie): bool
    {
        $query = Favorite::where('user_id', Auth::id());

        $query->where('movie_id', $movie->id);

        $favorite = $query->first();

        if (!$favorite) {
            return false;
        }

        return (bool) $favorite->delete();
    }
}
