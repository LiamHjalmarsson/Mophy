<?php 

namespace App\Actions\User;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, User $user): User
    {
        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'avatars/default.png') {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return $user;
    }
}
