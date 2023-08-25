<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\WeatherAlert;

class WeatherAlertNotification extends Notification
{
    use Queueable;
    protected $alert;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(WeatherAlert $alert)
    {
        $this->alert = $alert;
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
            ->subject('Weather Alert')
            ->line('The weather event you set an alert for has occurred.')
            ->line('Event: ' . $this->alert->event_type)
            ->line('Threshold: ' . $this->alert->threshold);
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
