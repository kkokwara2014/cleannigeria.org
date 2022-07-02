<?php

namespace App\Mail;

use App\Competenceassessmentuser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompetenceAssessmentSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comptassessuser;
    public $comptassessor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Competenceassessmentuser $comptassessuser, User $comptassessor)
    {
        $this->comptassessuser=$comptassessuser;
        $this->comptassessor=$comptassessor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.comptassess_submitted_mail')->with([
            'lastname'=>$this->comptassessuser->user->lastname,
            'firstname'=>$this->comptassessuser->user->firstname,
            'assessor_lastname'=>$this->comptassessor->lastname,
            'assessor_firstname'=>$this->comptassessor->firstname,
            'title'=>$this->comptassessuser->competenceassessment->title,
            'created_at'=>$this->comptassessuser->created_at,
        ]);
    }
}
