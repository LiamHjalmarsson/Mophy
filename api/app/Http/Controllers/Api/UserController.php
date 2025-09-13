<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function create() {

    }

    public function show (User $user) 
    {
        $user->load(['followers', 'following']);

        return new UserResource($user);
    }

    public function update() {

    }

    public function delete() {

    }
}
