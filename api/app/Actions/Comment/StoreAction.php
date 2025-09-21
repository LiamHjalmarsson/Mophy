<?php 

namespace App\Actions\Comment;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Comment
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        return Comment::create($validated);
    }
}
