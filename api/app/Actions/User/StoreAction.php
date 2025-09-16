<?php 

namespace App\Actions\User;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreAction 
{
    public function __invoke(StoreRequest $request): User
    {
        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
            $validated['avatar'] = 'avatars/default.png';
        }

        $validated['password'] = Hash::make($validated['password']);

        return User::create($validated);
    }
}
