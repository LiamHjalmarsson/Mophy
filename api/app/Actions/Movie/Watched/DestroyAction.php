<?php 

namespace App\Actions\Movie\Watched;

use App\Models\Movie;
use App\Models\Watched;

class DestroyAction 
{
    public function __invoke(?int $userId, Movie $movie): bool
    {
            if (!$userId) {
            return false;
        }

        $query = Watched::where('user_id', $userId);

        $query->where('movie_id', $movie->id);

        $watched = $query->first();

        if (!$watched) {
            return false;
        }

        return (bool) $watched->delete();
    }
}
