<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::query()
            ->select(['id', 'name', 'username', 'email', 'bio', 'thumbnail', 'created_at'])
            ->with(['chats' => function ($query) {
                $query->whereHas('messages')
                    ->select(['chats.id'])
                    ->selectSub(function ($query) {
                        $query->from('messages')
                            ->whereColumn('messages.chat_id', 'chats.id')
                            ->selectRaw('MAX(created_at)');
                    }, 'last_message_date')
                    ->selectSub(function ($query) {
                        $query->from('users')
                            ->whereColumn('chats.friend_id', 'users.id')
                            ->selectRaw('users.name');
                    }, 'friend_name')
                    ->selectSub(function ($query) {
                        $query->from('users')
                            ->whereColumn('chats.friend_id', 'users.id')
                            ->selectRaw('users.thumbnail');
                    }, 'friend_thumbnail')
                    ->orderByDesc('last_message_date');

            }])
            ->find($request->user()->id);
        return new UserResource($user);
    }
}
