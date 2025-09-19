<?php

namespace App\Http\Resources\MovieList;

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
            'title' => $this->title,
            'description' => $this->description,
            'cover_url' => $this->cover_url,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'username' => $this->user->username,
            ],
            'movies' => $this->movies->map(fn($movie) => [
                'id' => $movie->id,
                'title' => $movie->title,
                'description' => $movie->description,
                'duration' => $movie->duration,
                'cover_url' => $movie->cover_url,
            ]),
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
