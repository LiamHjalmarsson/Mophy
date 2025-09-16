<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\Avatar\UpdateAction as AvatarUpdateAction;
use App\Actions\User\StoreAction;
use App\Actions\User\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Avatar\UpdateRequest as AvatarUpdateRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\IndexResource;
use App\Http\Resources\User\ShowResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return IndexResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        Gate::authorize('create', User::class);

        $movie = $action($request);

        return new ShowResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new ShowResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user, UpdateAction $action)
    {
        Gate::authorize('update', $user);

        $updatedUser = $action($request, $user);

        return new ShowResource($updatedUser);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return response()->noContent();
    }

    public function updateAvatar(AvatarUpdateRequest $request, User $user, AvatarUpdateAction $action) 
    {
        Gate::authorize('update', $user);

        $updatedUser = $action($request, $user);

        return new ShowResource($updatedUser);
    }
}
