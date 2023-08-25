<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherAlert extends Model
{
    protected $table = "weather_alert";
    protected $fillable = ['event_type', 'threshold','user_id','city_id'];
}
