<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Throwable;

class DestroyController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Chat $chat): JsonResponse
    {
        Gate::authorize('forceDelete', $chat);

        $chat->deleteOrFail();

        return response()->json(['message' => 'OK']);
    }
}
