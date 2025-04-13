<?php

namespace App\Http\Controllers\API\Weather\Application\Service;

use App\Http\Controllers\API\Weather\Domain\Repositories\HistorieRepositoryInterface;


class RegisterHistorie
{
    private HistorieRepositoryInterface $historieRepository;

    public function __construct(HistorieRepositoryInterface $historieRepository)
    {
        $this->historieRepository = $historieRepository;
    }

    public function execute(array $data): array
    {          
        $historie = $this->historieRepository->create($data);       
        return  $historie->toArray();
       
    }
}