<?php

namespace App\Notifications;

use App\Srequipment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEquipmentNotification extends Notification
{
    use Queueable;

    public $srequipment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Srequipment $srequipment)
    {
        $this->srequipment=$srequipment;
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
        return (new MailMessage)->markdown('mail.srequipment.newequipment',['srequipment'=>$this->srequipment]);
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
