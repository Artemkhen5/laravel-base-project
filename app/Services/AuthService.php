<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function generateTokens(User $user): array
    {
        $user->tokens()->delete();
        $accessToken = $user->createToken('accessToken', ['access'], now()->addHour())->plainTextToken;
        $refreshToken = $user->createToken('refreshToken', ['refresh'], now()->addDay())->plainTextToken;
        return [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
        ];
    }
}
