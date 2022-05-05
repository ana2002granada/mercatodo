<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken('passport_token')->accessToken;

            return response()->json([
               'status' => 'OK',
               'message' =>  trans('passwords.authenticated'),
                'token' => $token,
            ]);
        }
        return response()->json([
               'status' => 'Error',
               'message' =>  trans('passwords.authenticated_error'),
            ], 401);
    }

    public function show(): JsonResponse
    {
        return response()->json([
            'status' => 'OK',
            'user' => auth()->user(),
        ]);
    }

    public function logout(): JsonResponse
    {
        $token = auth()->user()->token();

        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($token->id);

        return response()->json([
            'status' => 'OK',
            'message' => trans('passwords.logout')
        ]);
    }
}
