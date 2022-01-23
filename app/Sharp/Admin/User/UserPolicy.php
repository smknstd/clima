<?php

namespace App\Sharp\Admin\User;

use App\Models\User;

class UserPolicy
{
    public function entity(User $user)
    {
        return $user->isAdmin();
    }
}
