<?php

namespace App\Sharp\Admin\WeatherStation;

use App\Models\User;

class WeatherStationPolicy
{
    public function entity(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, $instanceId): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, $instanceId): bool
    {
        return $user->isAdmin();
    }
}
