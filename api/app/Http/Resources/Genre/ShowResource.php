<?php

namespace App\Http\Resources\Genre;

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
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $this->cover_url,
            'movies' => $this->movies(),
        ];
    }

    private function movies(): mixed
    {
        return $this->movies->map(function ($movie) {
            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'description' => $movie->description,
                'duration' => $movie->duration,
                'release_date' => $movie->release_date,
                'cover' => $movie->cover_url
            ];
        });
    }
}
