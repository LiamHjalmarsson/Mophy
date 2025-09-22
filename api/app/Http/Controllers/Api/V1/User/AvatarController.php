<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Actions\User\Avatar\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Avatar\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Models\User;

class AvatarController extends Controller
{
    public function update(UpdateRequest $request, User $user, UpdateAction $action) 
    {
        $updatedUser = $action($request, $user);

        return new ShowResource($updatedUser);
    }
}
