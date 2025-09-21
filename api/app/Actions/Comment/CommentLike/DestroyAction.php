<?php 

namespace App\Actions\Comment\CommentLike;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class DestroyAction 
{
    public function __invoke(Comment $comment): bool
    {
        $query = CommentLike::where('user_id', Auth::id());

        $query->where('comment_id', $comment->id);
            
        $like = $query->first();

        if (!$like) {
            return false;
        }

        return (bool) $like->delete();
    }
}
