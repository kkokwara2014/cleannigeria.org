<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PartnerCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $partner;
    public $partner_password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $partner, $partner_password)
    {
        $this->partner=$partner;
        $this->partner_password=$partner_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to CNA as Partner')->markdown('emails.partnercreationmail',[
            'partnername'=>$this->partner->firstname.' '.$this->partner->lastname,
            'partneremail'=>$this->partner->email,
            'partnerpassword'=>$this->partner_password,
        ]);
    }
}
