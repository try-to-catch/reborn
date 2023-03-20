<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Resources\API\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginFormRequest $request): JsonResponse|UserResource
    {

        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return new UserResource(auth()->user());
        }

        return response()->json(['errors' => ['email' => ['Invalid email address or password.'], 'password' => []]], 401);
    }
}
