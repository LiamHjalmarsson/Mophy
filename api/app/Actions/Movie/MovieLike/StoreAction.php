<?php 

namespace App\Actions\Movie\MovieLike;

use App\Http\Requests\Movie\MovieLike\StoreRequest;
use App\Models\Movie;
use App\Models\MovieLike;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): MovieLike
    {
        $validated = $request->validated();

        return MovieLike::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'movie_id' => $movie->id
            ],
            [
                'type' => $validated['type'],
            ]
        );
    }
}
