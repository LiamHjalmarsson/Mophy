<?php

namespace App\Actions\User\Follow;

use App\Http\Requests\User\Follow\StoreRequest;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class StoreAction
{
    public function __invoke(StoreRequest $request, User $user): Follow
    {
        $validated = $request->validated();

        return Follow::updateOrCreate(
            [
                'follower_id' => $validated['user_id'],
                'followed_id' => $user->id,
            ]
        );
    }
}
