<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login as Event;

class LoginEventListener
{
    /**
     * Handle the user authenticated event.
     *
     * @param \Illuminate\Auth\Events\Login $event
     */
    public function handle(Event $event): void
    {
        if ($event->user instanceof User) {
            $user = $event->user;
            $user->last_login_at = now();
            $user->save();
        }
    }
}
