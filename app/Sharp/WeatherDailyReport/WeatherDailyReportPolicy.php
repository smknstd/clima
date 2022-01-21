<?php

namespace App\Sharp\WeatherDailyReport;

use App\Models\User;

class WeatherDailyReportPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
