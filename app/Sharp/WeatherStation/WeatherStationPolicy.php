<?php

namespace App\Sharp\WeatherStation;

use App\Models\User;

class WeatherStationPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
