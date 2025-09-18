<?php 

namespace App\Actions\Movie\WatchLater;

use App\Models\Movie;
use App\Models\WatchLater;

class DestroyAction 
{
    public function __invoke(?int $userId, Movie $movie): bool
    {
        if (!$userId) {
            return false;
        }

        $query = WatchLater::where('user_id', $userId);

        $query->where('movie_id', $movie->id);

        $watchLater = $query->first();

        if (!$watchLater) {
            return false;
        }

        return (bool) $watchLater->delete();
    }
}
