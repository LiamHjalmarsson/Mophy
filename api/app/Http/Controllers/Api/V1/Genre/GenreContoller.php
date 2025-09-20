<?php

namespace App\Http\Controllers\Api\V1\Genre;

use App\Actions\Genre\StoreAction;
use App\Actions\Genre\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\StoreRequest;
use App\Http\Requests\Genre\UpdateRequest;
use App\Http\Resources\Genre\IndexResource;
use App\Http\Resources\Genre\ShowResource;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GenreContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::paginate(25);

        return IndexResource::collection($genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        Gate::authorize('create', User::class);

        $genre = $action($request);

        return new ShowResource($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $genre->load('movies');
        
        return new ShowResource($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Genre $genre, UpdateAction $action)
    {
        Gate::authorize('update', User::class);

        $updatedGenre = $action($request, $genre);

        return new ShowResource($updatedGenre); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        Gate::authorize('destroy', User::class);

        $genre->delete();

        return response()->noContent();
    }
}
