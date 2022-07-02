<?php

namespace App\Mail;

use App\Trainee;
use App\Trainingcert;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrainingCertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trainee, $traincert;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trainee $trainee, Trainingcert $traincert)
    {
        $this->trainee=$trainee;
        $this->traincert=$traincert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.trainingcertificate')->with([
            'trainee_firstname'=>$this->trainee->firstname,
            'trainee_lastname'=>$this->trainee->lastname,
            'training'=>$this->traincert->training->name,
            'certnumber'=>$this->traincert->certnumber,
        ])->attach(public_path($this->traincert));
    }
}
