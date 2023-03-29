<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Chat\ChatFormRequest;
use App\Models\ChatRequest;
use Illuminate\Http\Request;

class ChatRequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChatFormRequest $request)
    {
        dd($request->validated());
        $request->user()->charRequests();
    }
}
