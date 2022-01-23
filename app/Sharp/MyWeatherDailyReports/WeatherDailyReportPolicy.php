<?php

namespace App\Sharp\MyWeatherDailyReports;

use App\Models\User;

class WeatherDailyReportPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
