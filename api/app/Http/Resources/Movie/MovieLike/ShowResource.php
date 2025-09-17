<?php

namespace App\Http\Resources\Movie\MovieLike;

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
            'id' => $this->id,
            'movie_id' => $this->movie_id,
            'type' => $this->type, 
            'user' => [
                'id' => $this->user->id,
                'username' => $this->user->username,
            ],
            'created_at' => $this->created_at_formatted,
        ];
    }
}
