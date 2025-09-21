<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\StoreAction;
use App\Actions\Movie\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Resources\Movie\IndexResource;
use App\Http\Resources\Movie\ShowResource;
use App\Models\Movie;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with('creator')->paginate(25);

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
        $movie->load('creator');
        
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
}
