<?php

namespace App\Http\Controllers\API\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\ChatRequest\ChatRequestCollection;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request): ChatRequestCollection
    {
        $chatRequests = $request->user()->chatRequests()->with('sender')->where('was_considered', false)->oldest()->groupBy('sender_id')->get();

        return new ChatRequestCollection($chatRequests);
    }
}
