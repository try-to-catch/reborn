<?php

namespace App\Broadcasting;

use App\Models\Chat;
use App\Models\User;

class ChatChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, Chat $chat): array|bool
    {
        return auth()->check() && $chat->users()->where('users.id',$user->id)->exists();
    }
}
