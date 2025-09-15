<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rank')->paginate(10);

        return UserResource::collection($users);
    }

    public function store()
    {
        return response()->json("ss", 200);
    }


    public function show (User $user) 
    {
        $user->load(['rank', 'followers', 'following', 'achievements']);

        if (!$user) {
        }

        return new UserResource($user);
    }

    public function destroy(User $user) 
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
