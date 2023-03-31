<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Chat\ChatMinCollection;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $chats = request()->user()->chats()->select(['chats.id'])
            ->selectSub(function ($query) {
                $query->from('messages')
                    ->whereColumn('messages.chat_id', 'chats.id')
                    ->selectRaw('MAX(created_at)');
            }, 'last_message_date')
            ->with(['users' => function ($query) {
                $query->where('users.id', '!=', request()->user()->id);
            }])
            ->orderByDesc('last_message_date')->get();

        return new ChatMinCollection($chats);
    }
}
