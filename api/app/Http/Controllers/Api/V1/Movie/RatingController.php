<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\Rating\DestroyAction;
use App\Actions\Movie\Rating\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\Rating\StoreRequest;
use App\Http\Resources\Movie\Rating\ShowResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Movie $movie, StoreAction $action)
    {
        $rating = $action($request, $movie);

        $rating->load('user');

        return new ShowResource($rating);
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
    public function destroy(Movie $movie, DestroyAction $action)
    {
        $deleted = $action($movie);

        if (!$deleted) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        return response()->noContent();
    }
}
