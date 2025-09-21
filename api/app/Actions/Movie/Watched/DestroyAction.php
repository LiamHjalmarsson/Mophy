<?php 

namespace App\Actions\Movie\Watched;

use App\Models\Movie;
use App\Models\Watched;
use Illuminate\Support\Facades\Auth;

class DestroyAction 
{
    public function __invoke(Movie $movie): bool
    {
        $query = Watched::where('user_id', Auth::id());

        $query->where('movie_id', $movie->id);

        $watched = $query->first();

        if (!$watched) {
            return false;
        }

        return (bool) $watched->delete();
    }
}
