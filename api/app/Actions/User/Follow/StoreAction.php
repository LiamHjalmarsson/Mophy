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
        $followerId = Auth::id();

        return Follow::updateOrCreate(
            [
                'follower_id' => $followerId,
                'followed_id' => $user->id,
            ]
        );
    }
}
