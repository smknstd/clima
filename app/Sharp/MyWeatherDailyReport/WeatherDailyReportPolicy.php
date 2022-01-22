<?php

namespace App\Sharp\MyWeatherDailyReport;

use App\Models\User;

class WeatherDailyReportPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
