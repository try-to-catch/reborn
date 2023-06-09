<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Chat\ChatResource;
use App\Models\Chat;
use Illuminate\Support\Facades\Gate;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Chat $chat): ChatResource
    {
        Gate::authorize('view', $chat);

        $chatData = $chat->select('id')
            ->with([
                'messages' => function ($query) {
                    $query->limit(150);
                },
                'users' => function ($query) {
                    $query->where('users.id', '!=', request()->user()->id);
                }])->find($chat->id);

        return new ChatResource($chatData);
    }
}
