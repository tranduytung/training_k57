<?php

namespace App\Providers;

use App\Events\ForgotPassword;
use App\Listeners\ForgotPasswordListener;
use App\Listeners\MailSentListener;
use App\Listeners\NotificationSentListener;
use App\Listeners\RegisteredListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Mail\Events\MessageSending as MailSent;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MailSent::class => [
            MailSentListener::class,
        ],
        NotificationSent::class => [
            NotificationSentListener::class,
        ],
        Registered::class => [
            RegisteredListener::class,
        ],
        ForgotPassword::class => [
            ForgotPasswordListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
