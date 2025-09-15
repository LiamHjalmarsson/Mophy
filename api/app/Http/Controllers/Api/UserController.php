<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\CreateAction;
use App\Actions\User\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::with('rank')->withCount(['followers', 'following'])->paginate(5);

        return UserResource::collection($users);
    }

    public function store (CreateRequest $request, CreateAction $action)
    {
        $user = $action($request);

        return new UserResource($user);
    }


    public function show (User $user) 
    {
        $user->load(['rank', 'followers', 'following', 'achievements']);

        return new UserResource($user);
    }

    public function update (UpdateRequest $request, User $user, UpdateAction $action) 
    {
        $user = $action($request, $user);

        return new UserResource($user);
    }

    public function destroy (User $user) 
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
