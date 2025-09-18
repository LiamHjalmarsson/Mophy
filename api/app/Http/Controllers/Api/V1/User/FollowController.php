<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Actions\User\Follow\DestroyAction;
use App\Actions\User\Follow\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Follow\StoreRequest;
use App\Http\Resources\User\Follow\ShowResource;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
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
    public function store(StoreRequest $request, User $user, StoreAction $action)
    {
        $follow = $action($request, $user);

        $follow->load(['follower', 'followed']);

        return new ShowResource($follow);
        
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
    public function destroy(User $user, DestroyAction $action)
    {
        $deleted = $action($user);

        if (!$deleted) {
            return response()->json(['message' => 'Follow not found'], 404);
        }

        return response()->noContent();
    }

    public function followers(User $user) {
        $followers = $user->followers()->paginate(25);

        return ShowResource::collection($followers);
    }

    public function following(User $user) {
        $following = $user->following()->paginate(25);

        return ShowResource::collection($following);
    } 
}
