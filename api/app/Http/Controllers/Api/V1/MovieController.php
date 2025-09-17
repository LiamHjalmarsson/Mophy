<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Movie\MovieLike\DeleteAction;
use App\Actions\Movie\MovieLike\StoreAction as MovieLikeStoreAction;
use App\Actions\Movie\StoreAction;
use App\Actions\Movie\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieLike\StoreRequest as MovieLikeStoreRequest;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Resources\Movie\IndexResource;
use App\Http\Resources\Movie\MovieLike\ShowResource as MovieLikeShowResource;
use App\Http\Resources\Movie\ShowResource;
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

    public function reactToMovie(MovieLikeStoreRequest $request, Movie $movie, MovieLikeStoreAction $action) 
    {
        $like = $action($request, $movie);

        return new MovieLikeShowResource($like->load('user'));
    }

    public function removeReaction(Movie $movie, DeleteAction $action)
    {
        $deleted = $action(Auth::id(), $movie);

        if (!$deleted) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        return response()->noContent();
    }
}
