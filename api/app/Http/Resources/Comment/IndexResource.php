<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'body' => $this->body,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'username' => $this->user->username
            ],
            'movie_id' => $this->movie_id,
            'likes_count'    => $this->likes_count ?? 0,
            'dislikes_count' => $this->dislikes_count ?? 0,
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
