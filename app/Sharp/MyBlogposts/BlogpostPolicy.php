<?php

namespace App\Sharp\MyBlogposts;

use App\Models\Blogpost;
use App\Models\User;

class BlogpostPolicy
{
    public function entity(User $user)
    {
        return true;
    }

    public function update(User $user, $instanceId)
    {
        return $user->isAdmin() || (Blogpost::find($instanceId)->user_id === $user->is);
    }

    public function delete(User $user, $instanceId)
    {
        return $user->isAdmin() || (Blogpost::find($instanceId)->user_id === $user->is);
    }
}
