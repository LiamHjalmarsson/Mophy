<?php

namespace App\Http\Resources\Movie;

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
            'tmdb_id' => $this->tmdb_id,
            'title' => $this->title,
            'description' => $this->description,
            'release_date'=> $this->release_date,
            'duration' => $this->duration,
            'cover' => $this->cover_url,
            'creator' => [
                'id' => $this->creator?->id,
                'name' => $this->creator?->name,
            ],
            'genres' => $this->genres()
        ];
    }

    private function genres(): mixed
    {
        return $this->genres->map(function ($genre) {
            return [
                'id' => $genre->id,
                'title' => $genre->title
            ];
        });
    }
}
