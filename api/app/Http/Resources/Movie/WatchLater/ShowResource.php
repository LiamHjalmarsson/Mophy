<?php

namespace App\Http\Resources\Movie\WatchLater;

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
            'movie' => [
                'id' => $this->movie->id,
                'title' => $this->movie->title,
                'description' => $this->movie->description,
                'cover_url' => $this->movie->cover_url,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'username' => $this->user->username,
            ],
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
