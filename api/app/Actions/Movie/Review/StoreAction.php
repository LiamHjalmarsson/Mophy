<?php

namespace App\Actions\Movie\Review;

use App\Http\Requests\Movie\Review\StoreRequest;
use App\Models\Movie;
use App\Models\Review;

class StoreAction
{
    public function __invoke(StoreRequest $request, Movie $movie): Review
    {
        $validated = $request->validated();

        return Review::updateOrCreate(
            [
                'user_id'  => $request->user()->id,
                'movie_id' => $movie->id,
            ],
            [
                'rating' => $validated['rating'],
                'body'   => $validated['body'] ?? null,
            ]
        );
    }
}
