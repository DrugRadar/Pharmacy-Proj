<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientVerified extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return ['mail'];    
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
    ->subject('Welcome to our site!')
    ->greeting('Hello ' . $notifiable->name . ',')
    ->line('We wanted to take a moment to welcome you to our site.')
    ->line('Thank you for verifying your email address.');

}

public function toArray($notifiable)
{
return [
//
];
}
}