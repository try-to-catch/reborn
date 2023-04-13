<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Chat    $chat,
        public Message $message,
    )
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chats.' . $this->chat->id),
        ];
    }

    public function broadcastWith(): array
    {
        $date = $this->message->created_at;
        $formattedDate = $date->isToday()
            ? 'Today, in ' . $date->format('H:i')
            : $date->format('d.m.Y H:i');
        return ['message' =>
            [
                'id' => $this->message->id,
                'text' => $this->message->text,
                'user_id' => $this->message->user_id,
                'sent_at' => $formattedDate
            ]
        ];

    }
}
