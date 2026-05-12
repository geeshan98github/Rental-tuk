<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InfluencerWelcomeEmailNotification extends Notification
{
    use Queueable;

    private $user;
    private $password;
    private $siteUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $password, $siteUrl)
    {
        $this->user = $user;
        $this->password = $password;
        $this->siteUrl = $siteUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->greeting('Hello, '.$this->user->firstName)
                ->line('Welcome to TUK TUK.')
                ->line('Username : ' . $this->user->email)
                ->line('Password : ' . $this->password)
                ->action('Explore', $this->siteUrl)
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
