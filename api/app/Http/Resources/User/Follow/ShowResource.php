<?php

namespace App\Http\Resources\User\Follow;

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
            'follower' => [
                'id' => $this->follower->id,
                'username' => $this->follower->username,
            ],
            'followed' => [
                'id' => $this->followed->id,
                'username' => $this->followed->username,
            ],
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
