<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\UserResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::query()->select(['id', 'name', 'username', 'email', 'bio', 'thumbnail', 'created_at'])->with('chats')->find($request->user()->id);
//        return ['data' => $user];
        return new UserResource($user);
    }
}
