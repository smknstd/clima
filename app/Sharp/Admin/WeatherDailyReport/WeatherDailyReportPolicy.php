<?php

namespace App\Sharp\Admin\WeatherDailyReport;

use App\Models\User;

class WeatherDailyReportPolicy
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
