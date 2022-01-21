<?php

namespace App\Sharp\WeatherStation;

use App\Models\User;
use App\Models\WeatherStation;

class WeatherStationPolicy
{
    public function entity(User $user)
    {
        return true;
    }

    public function update(User $user, $instanceId): bool
    {
        return WeatherStation::find($instanceId)?->user_id === $user->id;
    }

    public function delete(User $user, $instanceId): bool
    {
        return WeatherStation::find($instanceId)?->user_id === $user->id;
    }
}
