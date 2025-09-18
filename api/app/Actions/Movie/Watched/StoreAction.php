<?php 

namespace App\Actions\Movie\Watched;

use App\Http\Requests\Movie\Watched\StoreRequest;
use App\Models\Movie;
use App\Models\Watched;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): ?Watched
    {
        $user = $request->user();

        if (!$user) {
            return null;
        }

        $validated = $request->validated();

        return Watched::updateOrCreate(
            [
                'user_id'  => $request->user()->id,
                'movie_id' => $movie->id,
            ],
            [
                'watched_at' => $validated['watched_at'] ?? now(),
            ]
        );
    }
}
