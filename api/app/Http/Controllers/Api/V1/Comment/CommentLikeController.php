<?php

namespace App\Http\Controllers\Api\V1\Comment;

use App\Actions\Comment\CommentLike\DestroyAction;
use App\Actions\Comment\CommentLike\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentLike\StoreRequest;
use App\Http\Resources\Comment\CommentLike\ShowResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function store(StoreRequest $request, Comment $comment, StoreAction $action) 
    {
        $like = $action($request, $comment);
        
        $like->load('user');

        return new ShowResource($like);
    }

    public function destroy(Comment $comment, DestroyAction $action) 
    {
        $deleted = $action($comment);

        if (!$deleted) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        return response()->noContent();
    }
}
