<?php

namespace App\Http\Resources\API\Chat;

use App\Http\Resources\API\Message\MessageCollection;
use App\Http\Resources\API\User\UserMinResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'messages' => new MessageCollection($this->messages),
            'friend' => new UserMinResource($this->users[0]),
        ];
    }
}
