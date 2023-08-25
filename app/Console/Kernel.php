<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\WeatherService;
use App\City;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
        $weatherService = new WeatherService('746ace9c394d47dea4e155350232408');
        $cities = City::all();

        foreach ($cities as $city) {
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
            // Update other weather-related data...

            $city->save();
        }
    })->daily(); // Run the task daily
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
