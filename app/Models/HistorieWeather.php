<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class HistorieWeather extends Model
{
    use HasUuids,HasFactory, Notifiable;
    //
    protected $table='histories_weather';
    protected $fillable = [
        'user_id',
        'city',
        'weatherapi_data',
    ];
}
