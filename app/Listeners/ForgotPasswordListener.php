<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\TokenForResetPassword;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordListener
{
    /**
     * @var TokenRepositoryInterface
     */
    protected $tokens;

    /**
     * @param TokenRepositoryInterface $tokens
     * TokenRepositoryInterface don't work here
     * 
     */
    //  public function __construct(TokenRepositoryInterface $tokens)
    //  {
    //  $this->tokens = $tokens;
    //  }

    /**
     * Handle the event.
     *
     * @param ForgotPassword $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        $token = app('auth.password.broker')->createToken($event->user);
        // TokenRepositoryInterface don't work here
        // $token = $this->tokens->create($event->user);
        if (method_exists($event->user, 'sendPasswordResetNotification')) {
            $event->user->sendPasswordToResetNotification($token);
        } else {
            Mail::to($event->user)->send(new TokenForResetPassword($event->user, $token));
        }
    }
}
