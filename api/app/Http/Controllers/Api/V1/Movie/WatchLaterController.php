<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\WatchLater\DestroyAction;
use App\Actions\Movie\WatchLater\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\WatchLater\StoreRequest;
use App\Http\Resources\Movie\WatchLater\IndexResource;
use App\Http\Resources\Movie\WatchLater\ShowResource;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $movies = $user->watchLaterMovies()->paginate(25);

        return IndexResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Movie $movie, StoreAction $action)
    {
        $watchLater = $action($request, $movie);

        if (!$watchLater) {
           return response()->json(['message' => 'Could not add movie to watch later'], 401);
        }

        $watchLater->load(['user', 'movie']);

        return new ShowResource($watchLater);
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
        $deleted = $action(Auth::id(), $movie);

        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->noContent();
    }
}
