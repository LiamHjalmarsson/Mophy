<?php

namespace App\Actions\Movie\Rating;

use App\Http\Requests\Movie\Rating\StoreRequest;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class StoreAction
{
    public function __invoke(StoreRequest $request, Movie $movie): Rating
    {
        $validated = $request->validated();

        return Rating::updateOrCreate(
            [
                'user_id'  => Auth::id(),
                'movie_id' => $movie->id,
            ],
            [
                'rating' => $validated['rating'],
            ]
        );
    }
}
