<?php

namespace App\Http\Controllers\API\Weather\Application\Service;

use App\Http\Controllers\API\Weather\Domain\Repositories\WeatherRepositoryInterface;


class CreateHistorie
{
    private WeatherRepositoryInterface $historieRepository;

    public function __construct(WeatherRepositoryInterface $historieRepository)
    {
        $this->historieRepository = $historieRepository;
    }

    public function execute(array $data): array
    {          
        $historie = $this->historieRepository->createHistorie($data);       
        return  $historie->toArray();
       
    }
}