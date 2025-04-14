<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Application\Service;

use Illuminate\Support\Facades\Auth;
class LogoutUser
{
    public function execute(): void
    {
        Auth::logout();
    }
}