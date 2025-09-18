<?php

namespace App\Http\Controllers\Api\V1\Comment;

use App\Actions\Comment\CommentLike\DestroyAction;
use App\Actions\Comment\CommentLike\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentLike\StoreRequest;
use App\Http\Resources\Comment\CommentLike\ShowResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function reaction(StoreRequest $request, Comment $comment, StoreAction $action) 
    {
        $like = $action($request, $comment);
        
        $like->load('user');

        return new ShowResource($like);
    }

    public function removeReaction(Comment $comment, DestroyAction $action) 
    {
        $deleted = $action(Auth::id(), $comment);

        if (!$deleted) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        return response()->noContent();
    }
}
