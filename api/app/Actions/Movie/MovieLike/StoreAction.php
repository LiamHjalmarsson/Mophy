<?php 

namespace App\Actions\Movie\MovieLike;

use App\Http\Requests\Movie\MovieLike\StoreRequest;
use App\Models\Movie;
use App\Models\MovieLike;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): MovieLike
    {
        $validated = $request->validated();

        return MovieLike::firstOrCreate([
            'user_id' => $validated["user_id"],
            'movie_id' => $movie->id
        ]);
    }
}
