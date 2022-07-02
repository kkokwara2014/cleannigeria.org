<?php

namespace App\Mail;

use App\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovedLeaveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Leave $leave)
    {
        $this->leave=$leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.approved.leave',['leave'=>$this->leave]);
    }
}
