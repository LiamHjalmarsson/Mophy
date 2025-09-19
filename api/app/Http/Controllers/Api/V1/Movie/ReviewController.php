<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\Review\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\Review\StoreRequest;
use App\Http\Resources\Movie\Review\IndexResource;
use App\Http\Resources\Movie\Review\ShowResource;
use App\Models\Movie;
use Illuminate\Http\Request;

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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
