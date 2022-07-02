<?php

namespace App\Mail;

use App\Masterdocregister;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MasterDocRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staffincharge;
    public $documregister;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Masterdocregister $documregister, User $staffincharge)
    {
        $this->documregister=$documregister;
        $this->staffincharge=$staffincharge;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.documregister.created')->with([
            'staff_lastname'=>$this->staffincharge->lastname,
            'staff_firstname'=>$this->staffincharge->firstname,
            'doctitle'=>$this->documregister->doctitle,
            'docnumber'=>$this->documregister->docnumber,
            'created_at'=>$this->documregister->created_at,
        ]);
    }
}
