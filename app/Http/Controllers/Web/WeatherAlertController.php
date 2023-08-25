<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WeatherAlert;
use App\City;

class WeatherAlertController extends Controller
{
    public function showAlertForm($city_id)
    {
        $city = City::find($city_id);
        return view('alert', compact('city_id'));
    }

    public function setAlert(Request $request,$city_id)
    {
        // Validate form data
         $user = auth()->user();
        $event = $request->input('event_type');
        $threshold = $request->input('threshold');

        $alert = new WeatherAlert([
            'user_id' => $user->id,
            'city_id' => $city_id,
            'event_type' => $event,
            'threshold' => $threshold,
        ]);

        $alert->save();

        return redirect()->back()->with('message', 'Alert set successfully.');

    }
}