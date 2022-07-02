<?php

namespace App\Mail;

use App\Trainingcert;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificateUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $certificate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trainingcert $certificate, User $user)
    {
        $this->user=$user;
        $this->certificate=$certificate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.certificate.certuploaded')->with([
            'staff_lastname'=>$this->user->lastname,
            'staff_firstname'=>$this->user->firstname,
            'trainee_firstname'=>$this->certificate->trainee->firstname,
            'trainee_lastname'=>$this->certificate->trainee->lastname,
            'training'=>$this->certificate->training->name,
            'certnumber'=>$this->certificate->certnumber,
            'created_at'=>$this->certificate->created_at,
        ]);
    }
}
