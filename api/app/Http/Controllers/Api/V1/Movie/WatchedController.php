<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Actions\Movie\Watched\DestroyAction;
use App\Actions\Movie\Watched\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\Watched\StoreRequest;
use App\Http\Resources\Movie\Watched\ShowResource;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class WatchedController extends Controller
{
    public function watched(StoreRequest $request, Movie $movie, StoreAction $action)
    {
        $watched = $action($request, $movie);

        if (!$watched) {
           return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $watched->load('user');

        return new ShowResource($watched);
    }

    public function unWatch(Movie $movie, DestroyAction $action) 
    {
        $deleted = $action(Auth::id(), $movie);

        if (!$deleted) {
            return response()->json(['message' => 'Watched entry not found'], 404);
        }

        return response()->noContent();
    }
}
