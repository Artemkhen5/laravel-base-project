<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class UserController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $input = $request->validated();
        $user = User::create($input);
        $tokens = $this->authService->generateTokens($user);
        return response()->json($tokens);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $input = $request->validated();
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $tokens = $this->authService->generateTokens(Auth::user());
            return response()->json($tokens);
        }
        return response()->json(['Wrong password or email'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json('logout');
    }

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function refreshTokens(Request $request)
    {
        if ($request->user()->currentAccessToken()->can('refresh')) {
            $tokens = $this->authService->generateTokens($request->user());
            return response()->json($tokens);
        }
        return response()->json(['message' => 'Can\'t refresh with this token'], 401);
    }
}
