<?php

namespace App\Http\Resources\Category;

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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $this->cover_url,
            'movies' => $this->categoryMovies()
        ];
    }

    private function categoryMovies(): mixed
    {
        return $this->whenLoaded('movies', function () {
            return $this->movies->map(function ($movie) {
                return [
                    'id' => $movie->id,
                    'title' => $movie->title,
                ];
            });
        });
    }
}
