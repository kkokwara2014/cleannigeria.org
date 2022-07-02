<?php

namespace App\Mail;

use App\Trainingcert;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificateApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $certificate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trainingcert $certificate)
    {
        $this->certificate=$certificate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.certificate.certapproved')->with([
            'trainee_firstname'=>$this->certificate->trainee->firstname,
            'trainee_lastname'=>$this->certificate->trainee->lastname,
            'training'=>$this->certificate->training->name,
            'certnumber'=>$this->certificate->certnumber,
        ]);
    }
}
