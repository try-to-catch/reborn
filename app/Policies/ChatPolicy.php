<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    public function view(User $user, Chat $chat): bool
    {
        return $user->chats()->where('chats.id', $chat->id)->exists();
    }

    public function forceDelete(User $user, Chat $chat): bool
    {
        return $user->chats()->where('chats.id', $chat->id)->exists();
    }
}
