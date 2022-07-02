<?php

namespace App\Mail;

use App\Models\Maintrequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Maintrequestmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mainrequest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Maintrequest $maintrequest)
    {
        $this->mainrequest=$maintrequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.maintrequestmail',[
            'maintcode'=>$this->mainrequest->maintcode,
            'notifier'=>$this->mainrequest->user->firstname.' '.$this->mainrequest->user->lastname,
            'membercompany'=>$this->mainrequest->membercompany,
            'directphone'=>$this->mainrequest->directphone,
            'dateofrequest'=>$this->mainrequest->dateofrequest,
            'equipmenttype'=>$this->mainrequest->equipmenttype,
            'equipmentlocation'=>$this->mainrequest->equipmentlocation,
            'expectedmaintdate'=>$this->mainrequest->expectedmaintdate,
        ]);
    }
}
