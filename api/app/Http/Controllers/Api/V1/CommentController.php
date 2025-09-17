<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comment\StoreAction;
use App\Actions\Comment\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\Comment\IndexResource;
use App\Http\Resources\Comment\ShowResource;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user')->paginate(25);

        return IndexResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        $comment = $action($request);

        return new ShowResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load('user');

        return new ShowResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Comment $comment, UpdateAction $action)
    {
        $updatedComment = $action($request, $comment);

        return new ShowResource($updatedComment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
