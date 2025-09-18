<?php

namespace App\Actions\User\Follow;

use App\Http\Requests\User\Follow\StoreRequest;
use App\Models\User;
use App\Models\Follow;

class DestroyAction
{
     public function __invoke(int $userId, User $user): bool
    {
        $query = Follow::where('follower_id', $userId);

        $query->where('followed_id', $user->id);

        $follow = $query->first();

        if (!$follow) {
            return false;
        }

        return (bool) $follow->delete();
    }
}
