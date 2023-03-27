<?php

namespace App\Http\Controllers\API\Message;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Message\StoreFormRequest;
use App\Http\Resources\API\Message\MessageResource;
use App\Models\Chat;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Chat $chat, StoreFormRequest $request): MessageResource
    {
        $message = $chat->messages()->create([
            'user_id' => $request->user()->id,
            'text' => $request->validated()['text']
        ]);
        broadcast(new MessageSent($chat, $message));

        return new MessageResource($message);
    }
}
