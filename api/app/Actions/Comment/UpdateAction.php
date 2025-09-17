<?php 

namespace App\Actions\Comment;

use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, Comment $comment): Comment
    {
        $validated = $request->validated();

        $comment->update($validated);

        return $comment;
    }
}
