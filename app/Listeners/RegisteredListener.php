<?php

namespace App\Listeners;

use App\Mail\WelcomeRegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     */
    public function handle(Registered $event)
    {
        if (method_exists($event->user, 'sendRegisteredNotification')) {
            $event->user->sendRegisteredNotification();
        } else {
            Mail::to($event->user)->send(new WelcomeRegisteredUser($event->user));
        }
    }
}
