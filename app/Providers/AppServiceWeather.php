<?php

namespace App\Providers;

use App\Http\Controllers\API\Weather\Infrastructure\Repositories\WeatherRepository;
use App\Http\Controllers\API\Weather\Domain\Repositories\WeatherRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceWeather extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(WeatherRepositoryInterface::class, WeatherRepository::class);        
    }

    public function boot()
    {
        //
    }
}
