<?php

namespace App\Sharp\MyWeatherDailyReports;

use App\Models\User;
use App\Models\WeatherDailyReport;

class WeatherDailyReportPolicy
{
    public function entity(User $user)
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, $instanceId)
    {
        return WeatherDailyReport::find($instanceId)->weatherStation->user_id === $user->id;
    }

    public function update(User $user, $instanceId)
    {
        return WeatherDailyReport::find($instanceId)->weatherStation->user_id === $user->id;
    }

    public function delete(User $user, $instanceId)
    {
        return WeatherDailyReport::find($instanceId)->weatherStation->user_id === $user->id;
    }
}
