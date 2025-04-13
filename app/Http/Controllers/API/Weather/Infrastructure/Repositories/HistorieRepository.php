<?php

namespace App\Http\Controllers\API\Weather\Infrastructure\Repositories;

use App\Http\Controllers\API\Weather\Domain\Repositories\HistorieRepositoryInterface;
use App\Models\HistorieWeather;

class HistorieRepository implements HistorieRepositoryInterface
{
    public function create(array $data): HistorieWeather
    {
        return HistorieWeather::create($data);
    }
}