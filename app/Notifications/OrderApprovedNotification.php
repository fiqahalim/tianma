<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderApprovedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('TianMa: Account Approved')
                    ->greeting('Hello!')
                    ->line('Your account has been approved! Please confirm the below information is correct')
                    ->line('Full Name: ' . $this->user->name)
                    ->line('ID Number \ Passport: ' . $this->user->id_number)
                    ->line('Email: ' . $this->user->email)
                    ->line('Username: ' . $this->user->username)
                    ->line('Contact Number: ' . $this->user->contact_no)
                    ->action('Login Here', route('login'))
                    ->line('Thank you for using TianMa application!');
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
            //
        ];
    }
}
