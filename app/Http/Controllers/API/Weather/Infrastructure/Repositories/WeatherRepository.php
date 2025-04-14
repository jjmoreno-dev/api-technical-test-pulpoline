<?php

namespace App\Http\Controllers\API\Weather\Infrastructure\Repositories;

use App\Http\Controllers\API\Weather\Domain\Repositories\WeatherRepositoryInterface;
use App\Models\FavoritesWeather;
use App\Models\HistorieWeather;

class WeatherRepository implements WeatherRepositoryInterface
{
    public function createHistorie(array $data): HistorieWeather
    {
        return HistorieWeather::create($data);
    }
    public function existsByIdHistories(string $histories_weather_id ): bool
    {
        return HistorieWeather::where('id', $histories_weather_id )->exists();
    }
    public function existsByfavorite(string $histories_weather_id,$user_id): bool
    {
        return FavoritesWeather::where([
            ['histories_weather_id','=',$histories_weather_id],
            ['user_id','=',$user_id],
        ])->exists();        
    }
    public function Createfavorite(array $data): FavoritesWeather
    {
        return FavoritesWeather::create($data);
    }
}