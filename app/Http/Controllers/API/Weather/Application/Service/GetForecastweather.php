<?php

namespace App\Http\Controllers\API\Weather\Application\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class GetForecastweather
{
    public function execute(array $data): array
    {
        if (empty($data["city"])) {            
            throw new \Exception(json_encode('City is required'));            
        }
       
        $city = "?q=".$data["city"];
        $days = "&days=1";
        $lang = empty($data["lang"]) ? '': "&lang=".$data["lang"];
        $apiBaseUrl = env('WEATHER_API_URL');
        $apiKey = "&key=".env('WEATHER_API_KEY');
        $url = "{$apiBaseUrl}{$city}{$lang}{$days}{$apiKey}";
        
        $response = Http::get($url);

    if ($response->failed()) {
        throw new \Exception(json_encode('Failed to fetch  get weather data'));
    }
        return json_decode($response, true);
    }
}