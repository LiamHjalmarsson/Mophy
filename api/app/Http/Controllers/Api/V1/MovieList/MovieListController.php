<?php

namespace App\Http\Controllers\Api\V1\MovieList;

use App\Actions\MovieList\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovieList\StoreRequest;
use App\Http\Resources\MovieList\IndexResource;
use App\Http\Resources\MovieList\ShowResource;
use App\Models\MovieList;
use App\Models\User;
use Illuminate\Http\Request;

class MovieListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = MovieList::with('user')->paginate(25);

        return IndexResource::collection($lists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        $list = $action($request);

        $list->load('user', 'movies');

        return new ShowResource($list);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, MovieList $movieList)
    {
        if ($movieList->user_id !== $user->id) {
            return response()->json([
                'message' => 'Movie list not found for this user'
            ], 404);
        }

        $movieList->load('movies', 'user');

        return new ShowResource($movieList);
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
