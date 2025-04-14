<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\IdentityAndAccess\Application\Service\RegisterUser;
use App\Http\Controllers\API\IdentityAndAccess\Application\Service\LoginUser;
use App\Http\Controllers\API\IdentityAndAccess\Application\Service\LogoutUser;
use App\Http\Controllers\API\IdentityAndAccess\Application\Service\RefreshToken;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    private RegisterUser $registerUser;
    private LoginUser $loginUser;
    private LogoutUser $logoutUser;
    private RefreshToken $refreshToken;

    public function __construct(
        RegisterUser $registerUser,
        LoginUser $loginUser,
        LogoutUser $logoutUser,
        RefreshToken $refreshToken
    ) {
        $this->registerUser = $registerUser;
        $this->loginUser = $loginUser;
        $this->logoutUser = $logoutUser;
        $this->refreshToken = $refreshToken;
    }

    public function register(Request $request)
    {
       
        try {
            $success = $this->registerUser->execute($request->all());
            return $this->sendResponse($success, 'User registered successfully.');
        } catch (\Exception $e) {
            return $this->sendResponse('Registration failed.', ['error' =>json_decode($e->getMessage())]);  
        }
    }

    public function login(Request $request)
    {
        try {
            $success = $this->loginUser->execute($request->only(['email', 'password']));
            return $this->sendResponse($success, 'User logged in successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Login failed.', ['error' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        $this->logoutUser->execute();
        return $this->sendResponse([], 'Successfully logged out.');
    }

    public function refresh()
    {
        $success = $this->refreshToken->execute();
        return $this->sendResponse($success, 'Token refreshed successfully.');
    }
}