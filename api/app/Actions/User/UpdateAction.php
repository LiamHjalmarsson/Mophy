<?php 

namespace App\Actions\User;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, User $user): User
    {
        $validated = $request->validated();

        $user->update($validated);

        return $user;
    }
}
