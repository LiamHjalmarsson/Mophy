<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
                'username' => $this->user->username
            ],
            'movie_id' => $this->movie_id,
            'created_at' => $this->created_at_formatted
        ];
    }
}
