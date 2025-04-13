<?php

namespace App\Http\Controllers\API\Weather\Domain\Repositories;

use App\Models\HistorieWeather;

interface HistorieRepositoryInterface
{
    public function create(array $data): HistorieWeather;

}