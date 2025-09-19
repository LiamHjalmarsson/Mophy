<?php

namespace App\Actions\Movie\Review;

use App\Http\Requests\Movie\Review\UpdateRequest;
use App\Models\Review;

class UpdateAction
{
    public function __invoke(UpdateRequest $request, Review $review): Review
    {
        $validated = $request->validated();

        $review->update($validated);

        return $review;
    }
}
