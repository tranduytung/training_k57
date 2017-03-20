<?php

namespace App\Notifications;

use App\Mail\WelcomeRegisteredUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserWasRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->onQueue('notification');
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
        return (new WelcomeRegisteredUser($this->user))->to($this->user->email);
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
            'time' => $this->user->created_at->format('c'),
        ];
    }
}
