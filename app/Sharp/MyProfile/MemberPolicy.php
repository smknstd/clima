<?php

namespace App\Sharp\MyProfile;

use App\Models\User;

class MemberPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
