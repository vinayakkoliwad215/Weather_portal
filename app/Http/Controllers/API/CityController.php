<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Services\WeatherService;
use App\City;

class CityController extends Controller
{ 

    public function addCity(Request $request)
    {
        $user = auth()->user();
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $city = new City([
            'name' => $request->input('name'),
            'country' => $request->input('country'),
        ]);
        $weatherService = new WeatherService('746ace9c394d47dea4e155350232408');
        $weatherData = $weatherService->getWeather($city->name);

        $city->temperature = $weatherData['current']['temp_c'];
        $city->temperature_fathe = $weatherData['current']['temp_f'];

        $city->weather_condition = $weatherData['current']['condition']['text'];
        $city->latitude = $weatherData['location']['lat'];
        $city->longitude = $weatherData['location']['lon'];
        $city->region = $weatherData['location']['region'];
        $city->humidity = $weatherData['current']['humidity'];
        $city->wind_mph = $weatherData['current']['wind_mph'];
        $city->wind_kph = $weatherData['current']['wind_kph'];


        $user->cities()->save($city);

        return response()->json(['message' => 'City added successfully'], 201);
    }

    public function removeCity(Request $request, $cityId)
    {
        $user = auth()->user();

        $city = City::find($cityId);
        $city->delete();

        return response()->json(['message' => 'City removed successfully']);
    }
}
?>