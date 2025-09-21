<?php 

namespace App\Actions\Movie\Watched;

use App\Http\Requests\Movie\Watched\StoreRequest;
use App\Models\Movie;
use App\Models\Watched;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Movie $movie): ?Watched
    {
        $validated = $request->validated();

        return Watched::updateOrCreate(
            [
                'user_id'  => Auth::id(),
                'movie_id' => $movie->id,
            ],
            [
                'watched_at' => $validated['watched_at'] ?? now(),
            ]
        );
    }
}
