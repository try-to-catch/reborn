<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordFormRequest $request): JsonResponse
    {
        $formData = $request->validated();

        $status = Password::sendResetLink(['email' => $formData['email']]);

        return response()->json([
            'status' => $status === Password::RESET_LINK_SENT ? __('passwords.sent') : __('passwords.user'),
        ], $status === Password::RESET_LINK_SENT ? 200 : 422);
    }
}
