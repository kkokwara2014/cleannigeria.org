<?php

namespace App\Mail;

use App\Mobilizationrequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MobrequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mobrequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mobilizationrequest $mobrequest)
    {
        $this->mobrequest=$mobrequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mobreq.mobilizationreq',['mobreq'=>$this->mobrequest]);
    }
}
