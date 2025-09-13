<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'country' => $this->country,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'followers_count' => $this->followers()->count(),
            'following_count' => $this->following()->count(),
            'created_at' => $this->created_at,
        ];
    }
}
