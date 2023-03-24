<?php

namespace App\Http\Resources\API\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = Carbon::create($this->created_at);

        return [
            'name' => $this->name,
            'username' => $this->username,
            'bio' => $this->bio ?? null,
            'joined_at' => $date->format('M. d, Y'),
            'thumbnail' => '/storage/'.$this->thumbnail,
        ];
    }
}
