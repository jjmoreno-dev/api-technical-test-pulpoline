<?php

namespace App\Providers;

use App\Http\Controllers\API\Weather\Infrastructure\Repositories\HistorieRepository;
use App\Http\Controllers\API\Weather\Domain\Repositories\HistorieRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceHistorie extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HistorieRepositoryInterface::class, HistorieRepository::class);        
    }

    public function boot()
    {
        //
    }
}
