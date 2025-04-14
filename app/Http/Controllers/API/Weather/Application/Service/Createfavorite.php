<?php

namespace App\Http\Controllers\API\Weather\Application\Service;

use App\Http\Controllers\API\Weather\Domain\Repositories\WeatherRepositoryInterface;
use Illuminate\Support\Facades\Validator;


class Createfavorite
{
    private WeatherRepositoryInterface $weatherRepository;

    public function __construct(WeatherRepositoryInterface $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function execute(array $data): array
    {
        $data['user_id'] = auth()->user()->id;        
        $validator = Validator::make($data, [
            'histories_weather_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()));
        }

        $historiesByIdExist = $this->weatherRepository->existsByIdHistories($data['histories_weather_id']);
        if (!$historiesByIdExist) {
            throw new \Exception(json_encode("Historie don't already exists!"));
        }

        $existsByfavorite = $this->weatherRepository->existsByfavorite($data['histories_weather_id'], $data['user_id']);
        if ($existsByfavorite) {
            throw new \Exception(json_encode("Weather forecast has already been previously added as a favorite"));
        }

        $favoritesWeather = $this->weatherRepository->Createfavorite($data);

        return $favoritesWeather->toArray();
    }
   
}