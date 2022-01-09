<?php

namespace App\Sharp\User;

use App\Models\User;

class UserPolicy
{
    public function entity(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, $userId)
    {
        return $user->isAdmin();
    }
}
