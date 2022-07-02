<?php

namespace App\Notifications;

use App\Hazardreport;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HazardreportNotification extends Notification
{
    use Queueable;

    public $hreport;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Hazardreport $hreport)
    {
        $this->hreport=$hreport;
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
        $receipient=User::find($this->hreport->sentto_id);
        return (new MailMessage)->markdown('mail.hazardreport',['hreport'=>$this->hreport,'receipient'=>$receipient]);
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
