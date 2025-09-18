<?php 

namespace App\Actions\Movie\WatchLater;

use App\Http\Requests\Movie\WatchLater\StoreRequest;
use App\Models\Movie;
use App\Models\WatchLater;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): ?WatchLater
    {
        $user = $request->user();

        if (!$user) {
            return null;
        }

        $validated = $request->validated();

        return WatchLater::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'movie_id' => $movie->id,
            ]
        );
    }
}
