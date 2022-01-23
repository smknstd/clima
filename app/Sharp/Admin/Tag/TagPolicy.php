<?php

namespace App\Sharp\Admin\Tag;


use App\Models\User;

class TagPolicy
{
    public function entity(User $user)
    {
        return $user->isAdmin();
    }
}
