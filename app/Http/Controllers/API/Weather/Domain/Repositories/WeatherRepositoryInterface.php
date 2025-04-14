<?php

namespace App\Http\Controllers\API\Weather\Domain\Repositories;

use App\Models\HistorieWeather;
use App\Models\FavoritesWeather;

interface WeatherRepositoryInterface
{
    public function createHistorie(array $data): HistorieWeather;
    public function Createfavorite(array $data): FavoritesWeather;
    public function existsByIdHistories(string $histories_weather_id): bool;
    public function existsByfavorite(string $histories_weather_id,$user_id): bool;

}