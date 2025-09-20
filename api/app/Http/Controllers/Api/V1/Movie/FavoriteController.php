<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\Favorite\DestroyAction;
use App\Actions\Movie\Favorite\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\Favorite\StoreRequest;
use App\Http\Resources\Movie\Favorite\IndexResource;
use App\Http\Resources\Movie\Favorite\ShowResource;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        if ($user->id !== Auth::id() && !$user->favorites()->where('is_public', true)->exists()) {
           return response()->json(['message' => 'Favorites are private'], 403);
        }

        $favorites = $user->favoriteMovies()->wherePivot('is_public', true)->paginate(25);

        return IndexResource::collection($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Movie $movie, StoreAction $action)
    {
        $favorite = $action($request, $movie);

        $favorite->load('user', 'movie');

        return new ShowResource($favorite);
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

        if (! $deleted) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        return response()->noContent();
    }
}
