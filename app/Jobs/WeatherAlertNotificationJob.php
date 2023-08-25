<?php

namespace App\Jobs;

use App\User;
use App\Models\WeatherAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherAlertNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $weatherAlerts = WeatherAlert::all();

        foreach ($weatherAlerts as $alert) {
            if ($this->weatherDataMeetsCondition($alert)) {
                $user = User::find($alert->user_id);
                $user->notify(new WeatherAlertNotification($alert));
            }
        }
    }
}
