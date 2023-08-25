<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use App\City;

class CityController extends Controller
{
    public function addCity(Request $request)
    {
        $user = auth()->user();

        $city = new City([
            'name' => $request->input('city'),
        ]);

        $weatherService = new WeatherService('746ace9c394d47dea4e155350232408');
        $weatherData = $weatherService->getWeather($city->name);
        
        $city->temperature = $weatherData['current']['temp_c'];
        $city->temperature_fathe = $weatherData['current']['temp_f'];
        $city->country = $weatherData['location']['country'];

        $city->weather_condition = $weatherData['current']['condition']['text'];
        $city->latitude = $weatherData['location']['lat'];
        $city->longitude = $weatherData['location']['lon'];
        $city->region = $weatherData['location']['region'];
        $city->humidity = $weatherData['current']['humidity'];
        $city->wind_mph = $weatherData['current']['wind_mph'];
        $city->wind_kph = $weatherData['current']['wind_kph'];


        $user->cities()->save($city);

        return redirect()->back()->with('message', 'City added successfully.');
    }

    public function getUserCities()
	{
	    $user = auth()->user();
	    $cities = $user->cities;
	    return view('home', compact('cities'));
	}
}
