<?php

namespace App\Sharp\MyWeatherStation;

use App\Models\User;

class WeatherStationPolicy
{
    public function entity(User $user)
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function delete(User $user, $instanceId): bool
    {
        return false;
    }
}
