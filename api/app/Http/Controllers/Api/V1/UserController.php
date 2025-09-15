<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\User\IndexResource;
use App\Http\Resources\User\ShowResource;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function updateAvatar() {

    }
}
