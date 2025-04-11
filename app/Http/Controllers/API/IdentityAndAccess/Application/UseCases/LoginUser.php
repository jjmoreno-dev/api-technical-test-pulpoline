<?php
namespace App\Http\Controllers\API\IdentityAndAccess\Application\UseCases;
use Illuminate\Support\Facades\Auth;
class LoginUser
{
    public function execute(array $credentials): array
    {
        if (!$token = Auth::attempt($credentials)) {
            throw new \Exception('Unauthorized');
        }
        return ['access_token' => $token, 'token_type' => 'bearer', 'expires_in' => Auth::factory()->getTTL() * 60,];
    }
}