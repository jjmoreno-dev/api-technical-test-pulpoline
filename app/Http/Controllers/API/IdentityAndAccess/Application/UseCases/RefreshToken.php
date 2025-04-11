<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Application\UseCases;

use Illuminate\Support\Facades\Auth;
class RefreshToken
{
    public function execute(): array
    {
        $token = Auth::refresh();
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }
}