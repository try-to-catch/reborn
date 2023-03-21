<?php

namespace App\Http\Resources\API;

use App\Http\Resources\API\Chat\ChatMinCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'bio' => $this->bio ?? null,
            'created_at' => $this->created_at,
            'thumbnail' => '/storage/'.$this->thumbnail,
            'chats' => new ChatMinCollection($this->chats)
        ];
    }
}
