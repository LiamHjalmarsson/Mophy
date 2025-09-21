<?php 

namespace App\Actions\Movie\MovieLike;

use App\Models\Movie;
use App\Models\MovieLike;
use Illuminate\Support\Facades\Auth;

class DestroyAction 
{
    public function __invoke(Movie $movie): bool
    {
        $query = MovieLike::where('user_id', Auth::id());

        $query->where('movie_id', $movie->id);

        $like = $query->first();

        if (!$like) {
            return false;
        }

        return (bool) $like->delete();
    }
}
