<?php

namespace App\Policies;

use App\Models\ChatRequest;
use App\Models\User;

class ChatRequestPolicy
{
    public function update(User $user, ChatRequest $chatRequest): bool
    {
        return $chatRequest->user()->value('users.id') === $user->id;
    }
}
