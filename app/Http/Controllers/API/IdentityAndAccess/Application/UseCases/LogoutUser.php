<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Application\UseCases;

use Illuminate\Support\Facades\Auth;
class LogoutUser
{
    public function execute(): void
    {
        Auth::logout();
    }
}