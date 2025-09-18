<?php 

namespace App\Actions\Comment\CommentLike;

use App\Models\Comment;
use App\Models\CommentLike;

class DestroyAction 
{
    public function __invoke(?int $userId, Comment $comment): bool
    {
        if (!$userId) {
            return false;
        }

        $query = CommentLike::where('user_id', $userId);

        $query->where('comment_id', $comment->id);
            
        $like = $query->first();

        if (!$like) {
            return false;
        }

        return (bool) $like->delete();
    }
}
