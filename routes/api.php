<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;    
use App\Http\Controllers\API\WeatherController;    


 
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group(["middleware" => ["auth:api"]], function(){

   // Route::get('weather/forecast', [WeatherController::class, 'forecast']);
    Route::get('forecastweather', [WeatherController::class, 'forecastweather']);
    Route::post('favorite', [WeatherController::class, 'favorite']);
    
});



