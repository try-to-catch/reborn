<?php

namespace App\Http\Controllers\API\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ChatRequest\StoreFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreFormRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $user = User::find($requestData['id']);

        $user->chatRequests()->create([
            'sender_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'OK']);
    }
}
