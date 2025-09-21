<?php 

namespace App\Actions\Movie\WatchLater;

use App\Models\Movie;
use App\Models\WatchLater;
use Illuminate\Support\Facades\Auth;

class DestroyAction 
{
    public function __invoke(Movie $movie): bool
    {
        $query = WatchLater::where('user_id', Auth::id());

        $query->where('movie_id', $movie->id);

        $watchLater = $query->first();

        if (!$watchLater) {
            return false;
        }

        return (bool) $watchLater->delete();
    }
}
