<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Movie\MovieLike\DestroyAction;
use App\Actions\Movie\MovieLike\StoreAction as MovieLikeStoreAction;
use App\Actions\Movie\StoreAction;
use App\Actions\Movie\UpdateAction;
use App\Actions\Movie\Watched\DestroyAction as WatchedDestroyAction;
use App\Actions\Movie\Watched\StoreAction as WatchedStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieLike\StoreRequest as MovieLikeStoreRequest;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Requests\Movie\Watched\StoreRequest as WatchedStoreRequest;
use App\Http\Resources\Movie\IndexResource;
use App\Http\Resources\Movie\MovieLike\ShowResource as MovieLikeShowResource;
use App\Http\Resources\Movie\ShowResource;
use App\Http\Resources\Movie\Watched\ShowResource as WatchedShowResource;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();

        return IndexResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        $movie = $action($request);

        return new ShowResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return new ShowResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Movie $movie, UpdateAction $action)
    {
        Gate::authorize('update', $movie);

        $updatedMovie  = $action($request, $movie);

        return new ShowResource($updatedMovie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Gate::authorize('delete', $movie);

        $movie->delete();

        return response()->noContent();
    }

    public function react(MovieLikeStoreRequest $request, Movie $movie, MovieLikeStoreAction $action) 
    {
        $like = $action($request, $movie);

        $like->load('user');

        return new MovieLikeShowResource($like);
    }

    public function removeReaction(Movie $movie, DestroyAction $action)
    {
        $deleted = $action(Auth::id(), $movie);

        if (!$deleted) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        return response()->noContent();
    }

    public function watched(WatchedStoreRequest $request, Movie $movie, WatchedStoreAction $action)
    {
        $watched = $action($request, $movie);

        if (!$watched) {
           return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $watched->load('user');

        return new WatchedShowResource($watched);
    }

    public function unWatch(Movie $movie, WatchedDestroyAction $action) 
    {
        $deleted = $action(Auth::id(), $movie);

        if (!$deleted) {
            return response()->json(['message' => 'Watched entry not found'], 404);
        }

        return response()->noContent();
    }
}
