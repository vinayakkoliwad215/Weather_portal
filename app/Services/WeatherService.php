<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getWeather($cityName)
    {
        $response = Http::get("http://api.weatherapi.com/v1/current.json", [
            'key' => $this->apiKey,
            'q' => $cityName,
        ]);

        return $response->json();
    }
}
