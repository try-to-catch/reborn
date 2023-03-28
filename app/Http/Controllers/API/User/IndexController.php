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
            ->find($request->user()->id);
        return new UserResource($user);
    }
}
