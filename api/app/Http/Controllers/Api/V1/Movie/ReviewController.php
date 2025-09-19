<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\Review\StoreAction;
use App\Actions\Movie\Review\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\Review\StoreRequest;
use App\Http\Requests\Movie\Review\UpdateRequest;
use App\Http\Resources\Movie\Review\IndexResource;
use App\Http\Resources\Movie\Review\ShowResource;
use App\Models\Movie;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Movie $movie)
    {
        $reviews = $movie->reviews()->with('user')->paginate(25);

        return IndexResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Movie $movie, StoreAction $action)
    {
        $review = $action($request, $movie);

        $review->load('user', 'movie');

        return new ShowResource($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie, Review $review)
    {
        $review->load('user', 'movie');

        return new ShowResource($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Movie $movie, Review $review, UpdateAction $action)
    {
        if ($review->movie_id !== $movie->id) {
            return response()->json(['message' => 'Review not found for this movie'], 404);
        }

        $updated = $action($request, $review);

        $updated->load('user', 'movie');

        return new ShowResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie, Review $review)
    {
        $review->delete();
        
        return response()->noContent();
    }
}
