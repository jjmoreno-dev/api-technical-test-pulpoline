<?php

namespace App\Providers;

use App\Http\Controllers\API\IdentityAndAccess\Infrastructure\Repositories\UserRepository;
use App\Http\Controllers\API\IdentityAndAccess\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot()
    {
        //
    }
}
