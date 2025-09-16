<?php 

namespace App\Actions\User\Avatar;

use App\Http\Requests\User\Avatar\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, User $user): User
    {
       $request->validated();

        if ($user->avatar && $user->avatar !== 'avatars/default.png') {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        
        $user->update(['avatar' => $path]);

        return $user;
    }
}
