<?php

namespace App\Notifications;

use App\Mail\TokenForResetPassword;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Password will reset notification
 *
 * @package App\Notifications
 */
class PasswordWillReset extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    public $queue = 'notification';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage|\Illuminate\Contracts\Mail\Mailable
     */
    public function toMail($notifiable)
    {
        return (new TokenForResetPassword($this->user))->to($this->user->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => [
                'username' => (string) $this->user->username,
                'email' => (string) $this->user->email,
                'avatar' => (string) $this->user->avatar,
            ],
            'token' => (string) $this->token,
            'time' => date('c'),
        ];
    }
}
