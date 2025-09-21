<?php 

namespace App\Actions\Movie\WatchLater;

use App\Http\Requests\Movie\WatchLater\StoreRequest;
use App\Models\Movie;
use App\Models\WatchLater;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): ?WatchLater
    {
        $request->validated();

        return WatchLater::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'movie_id' => $movie->id,
            ]
        );
    }
}
