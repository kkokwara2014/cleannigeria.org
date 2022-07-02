<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Workorder;

class WorkorderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $workorder;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Workorder $workorder)
    {
        $this->workorder=$workorder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.workorder.created')->with([
            'workordersender'=>$this->workorder->user->firstname.' '.$this->workorder->user->lastname,
            'workordernumber'=>$this->workorder->uniquecode,
            'workordersre'=>$this->workorder->srequipment->name,
            'workorderamount'=>$this->workorder->amount,
            'workorderdescription'=>$this->workorder->description,
            'created_at'=>$this->workorder->created_at,
        ]);
    }
}
