<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\MovieLike\DestroyAction;
use App\Actions\Movie\MovieLike\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieLike\StoreRequest;
use App\Http\Resources\Movie\MovieLike\ShowResource;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(StoreRequest $request, Movie $movie, StoreAction $action) 
    {
        $like = $action($request, $movie);

        $like->load('user');

        return new ShowResource($like);
    }

    public function destroy(Movie $movie, DestroyAction $action)
    {
        $deleted = $action($movie);

        if (!$deleted) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        return response()->noContent();
    }
}
