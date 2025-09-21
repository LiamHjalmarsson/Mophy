<?php

namespace App\Http\Resources\Movie\Watched;

use Carbon\Carbon;
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
            'title' => $this->title,
            'description' => $this->description,
            'duration' => $this->duration,
            'cover_url' => $this->cover_url,
            'watched_at' => $this->pivot?->watched_at?->format('Y-m-d H:i'),
        ];
    }
}
