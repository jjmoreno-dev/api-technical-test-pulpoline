<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Infrastructure\Repositories;

use App\Http\Controllers\API\IdentityAndAccess\Domain\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function existsByEmail(string $email): bool
    {
        return User::where('email', $email)->exists();
    }
}