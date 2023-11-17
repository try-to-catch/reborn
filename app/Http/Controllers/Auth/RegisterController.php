<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Resources\API\User\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterFormRequest $request): JsonResponse|UserResource
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        try {
            $user = User::query()->create($data);

            Auth::login($user);
        } catch (Exception $e) {
            return response()->json($e, 401);
        }

        try {
            event(new Registered($user));
        }
        catch(Exception $e) {
            error_log($e->getMessage());
        }

        return new UserResource($user);
    }
}
