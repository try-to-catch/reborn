<?php

namespace App\Http\Controllers\API\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ChatRequest\UpdateFormRequest;
use App\Models\Chat;
use App\Models\ChatRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UpdateController extends Controller
{
    public function __invoke(UpdateFormRequest $request, ChatRequest $chatRequest)
    {
        Gate::authorize('update', $chatRequest);

        $data = $request->validated();
        $chatRequest->was_considered = true;
        $chatRequest->save();

        if ($data['is_accept']){
            $chat = Chat::create();

            request()->user()->chats()->attach($chat);
            User::find($data['sender_id'])->chats()->attach($chat);
        }

        return response()->json(['message' => 'OK']);
    }
}
