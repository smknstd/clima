<?php

namespace App\Sharp\Admin\User;

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

    public function update(User $user, $userId)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, $userId)
    {
        return $user->isAdmin();
    }
}
