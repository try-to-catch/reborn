<?php

namespace App\Http\Resources\API\Message;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = Carbon::create($this->created_at);

        $formattedDate = $date->isToday()
            ? 'Today, in ' . $date->format('H:i')
            : $date->format('d.m.Y H:i');

        return [
            'id' => $this->id,
            'text' => $this->text,
            'user_id' => $this->user_id,
            'sent_at' => $formattedDate
        ];
    }
}
