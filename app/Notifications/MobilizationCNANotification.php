<?php

namespace App\Notifications;

use App\Mobilizationrequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MobilizationCNANotification extends Notification
{
    use Queueable;

    public $mobreq;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mobilizationrequest $mobreq)
    {
        $this->mobreq=$mobreq;
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
        return (new MailMessage)->markdown('emails.mobilization.cnamobnotification',['mobreq'=>$this->mobreq]);
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
