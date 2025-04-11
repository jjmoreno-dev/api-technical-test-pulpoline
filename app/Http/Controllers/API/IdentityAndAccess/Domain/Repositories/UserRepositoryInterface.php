<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Domain\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function existsByEmail(string $email): bool;


}