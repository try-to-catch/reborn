<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Throwable;

class DestroyController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Chat $chat): JsonResponse
    {
        $chat->deleteOrFail();

        return response()->json(['message' => 'OK']);
    }
}
