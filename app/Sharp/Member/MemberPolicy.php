<?php

namespace App\Sharp\Member;

use App\Models\User;

class MemberPolicy
{
    public function entity(User $user)
    {
        return true;
    }
}
