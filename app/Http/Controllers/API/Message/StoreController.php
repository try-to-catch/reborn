<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Message\StoreFormRequest;
use App\Http\Resources\API\Message\MessageResource;
use App\Models\Chat;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Chat $chat, StoreFormRequest $request)
    {
        $message = $chat->messages()->create([
            'user_id' => $request->user()->id,
            'text' => $request->validated()['text']
        ]);

        return new MessageResource($message);
    }
}
