<?php 

namespace App\Actions\Comment;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Comment
    {
        $validated = $request->validated();

        return Comment::create($validated);
    }
}
