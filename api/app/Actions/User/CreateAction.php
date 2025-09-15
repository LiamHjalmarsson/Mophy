<?php 

namespace App\Actions\User;

use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAction 
{
    public function __invoke(CreateRequest $request): User
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated ['password']);

        return User::create($validated);
    }
}
