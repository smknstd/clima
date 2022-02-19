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

    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, $instanceId)
    {
        if (!$instanceId) {
            return false;
        }
        return Blogpost::find($instanceId)->user_id === $user->id;
    }

    public function update(User $user, $instanceId)
    {
        if (!$instanceId) {
            return false;
        }
        return Blogpost::find($instanceId)->user_id === $user->id;
    }

    public function delete(User $user, $instanceId)
    {
        if (!$instanceId) {
            return false;
        }
        return Blogpost::find($instanceId)->user_id === $user->id;
    }
}
