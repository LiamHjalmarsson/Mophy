<?php 

namespace App\Actions\Movie\MovieLike;

use App\Models\Movie;
use App\Models\MovieLike;

class DestroyAction 
{
    public function __invoke(?int $userId, Movie $movie): bool
    {
        if (!$userId) {
            return false;
        }

        $query = MovieLike::where('user_id', $userId);

        $query->where('movie_id', $movie->id);

        $like = $query->first();

        if (!$like) {
            return false;
        }

        return (bool) $like->delete();
    }
}
