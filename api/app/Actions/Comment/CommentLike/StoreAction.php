<?php 

namespace App\Actions\Comment\CommentLike;

use App\Http\Requests\Comment\CommentLike\StoreRequest;
use App\Models\Comment;
use App\Models\CommentLike;

class StoreAction 
{
    public function __invoke(StoreRequest $request, Comment $comment): CommentLike
    {
        $validated = $request->validated();

        return CommentLike::updateOrCreate(
            [
                'user_id'    => $validated['user_id'],
                'comment_id' => $comment->id,
            ],
            [
                'type' => $validated['type'],
            ]
        );
    }
}
