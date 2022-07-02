<?php

namespace App\Notifications;

use App\Replenish;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReplenishedNotification extends Notification
{
    use Queueable;

    public $replenish;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Replenish $replenish)
    {
        $this->replenish=$replenish;
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
        $gm=User::where('role_id','2')->first();
        return (new MailMessage)->markdown('mail.leave.replenishment',['replenish'=>$this->replenish,'gm'=>$gm]);
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
