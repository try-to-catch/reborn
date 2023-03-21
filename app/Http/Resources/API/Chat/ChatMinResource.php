<?php

namespace App\Http\Resources\API\Chat;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMinResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date =  Carbon::create($this->last_message_date);
        return [
            'id' => $this->id,
            "last_message_date" => $date->isToday()?$date->format('H:i'):$date->format('M d'),
            "friend_name" => $this->friend_name,
            "friend_thumbnail" => '/storage/'.$this->friend_thumbnail,
        ];
    }
}
