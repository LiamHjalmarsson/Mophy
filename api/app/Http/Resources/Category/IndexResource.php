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
            'cover' => $this->coverImage(),
        ];
    }

    private function coverImage () {
        if ($this->cover) {
            return  asset('storage/' . $this->cover);
        } else {
            return asset('storage/defaults/category-cover.png');
        }
    }
}
