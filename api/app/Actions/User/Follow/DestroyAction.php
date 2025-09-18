<?php

namespace App\Actions\User\Follow;

use App\Http\Requests\User\Follow\StoreRequest;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class DestroyAction
{
     public function __invoke(User $user): bool
    {
        $followerId = Auth::id(); 

        $query = Follow::where('follower_id', $followerId);

        $query->where('followed_id', $user->id);

        $follow = $query->first();

        if (!$follow) {
            return false;
        }

        return (bool) $follow->delete();
    }
}
