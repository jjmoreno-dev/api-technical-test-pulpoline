<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Weather\Application\Service\Createfavorite;
use App\Http\Controllers\API\Weather\Application\Service\GetForecastweather;
use App\Http\Controllers\API\Weather\Application\Service\CreateHistorie;


use Illuminate\Http\Request;

class WeatherController extends BaseController
{
    private GetForecastweather $getForecast;
    private CreateHistorie $createHistorie;
    private Createfavorite $createfavorite;

    public function __construct(        
        GetForecastweather $getForecast,
        CreateHistorie $createHistorie,
        Createfavorite $createfavorite,
    ) {       
        $this->getForecast = $getForecast;
        $this->createHistorie = $createHistorie;
        $this->createfavorite = $createfavorite;
    }
    
    public function favorite(Request $request){
        try {
            $success = $this->createfavorite->execute($request->all());
            return $this->sendResponse($success, 'Favorite registered successfully.');
        } catch (\Exception $e) {
            return $this->sendResponse('Registration failed.', ['error' =>json_decode($e->getMessage())]);  
        }
    }
    public function forecastweather(Request $request){
        try {
            $getDataEndPoint = $this->getForecast->execute($request->all());           
            $dataCreateHistory=[
                'user_id'=>auth()->user()->id,
                'city'=>$request->input('city'),
                'weatherapi_data'=>json_encode($getDataEndPoint),
            ];
                       
            try {
                $dataHistorie = $this->createHistorie->execute( $dataCreateHistory);               
                $weatherApiAata=json_decode($dataHistorie['weatherapi_data']);
                return $this->sendResponse([
                     'id_historie'=> $dataHistorie['id'],
                     'user_id'=> $dataHistorie['user_id'],
                     'city'=> $dataHistorie['city'],
                     'localtime'=> $weatherApiAata->location->localtime,
                     'region'=> $weatherApiAata->location->region,
                     'country'=> $weatherApiAata->location->country,
                     'status'=> $weatherApiAata->current->condition->text,
                     'temp_c'=> $weatherApiAata->current->temp_c,
                     'temp_f'=> $weatherApiAata->current->temp_f,              
                     'humidity'=> $weatherApiAata->current->humidity,
                     'wind'=> [
                         'wind_mph'=>  $weatherApiAata->current->wind_mph,
                         'wind_kph'=>  $weatherApiAata->current->wind_kph,
                         'wind_degree'=>  $weatherApiAata->current->wind_degree,
                         'wind_dir'=>  $weatherApiAata->current->wind_dir,
                     ],                     
                 ], 'Register Historie  Weather successfully.'); 
            } catch (\Exception $e) {
                return $this->sendResponse('Register Historie failed.', ['error' =>json_decode($e->getMessage())]);  
            }        
          
        } catch (\Exception $e) {
            return $this->sendResponse('Get Forecast weather failed.', ['error' =>json_decode($e->getMessage())]);  
        }
    }
  
}