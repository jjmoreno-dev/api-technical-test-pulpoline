<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoritesWeather extends Model
{
    use HasUuids, HasFactory, Notifiable;
    //
    protected $table = 'favorites_weather';
    protected $fillable = [
        'user_id',
        'histories_weather_id',
    ];

    public function user(): BelongsTo
    {       
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
    public function historie(): BelongsTo
    {       
        return $this->belongsTo(HistorieWeather::class, 'histories_weather_id', 'id');

    }
}
