<?php

namespace App\Mail;

use App\Workorder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkorderApprovalMail extends Mailable
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
        return $this->markdown('emails.workorder.approval')->with([
            'approver'=>$this->workorder->firstapprover,
            'approvaldate'=>$this->workorder->firstapproveddate,
            'firstapprovercomment'=>$this->workorder->firstapprovercomment,
            'workordernumber'=>$this->workorder->uniquecode,
            'workordersre'=>$this->workorder->srequipment->name,
            'workorderamount'=>$this->workorder->amount,
            'workorderdescription'=>$this->workorder->description,
            'workordersender'=>$this->workorder->user->firstname.' '.$this->workorder->user->lastname,
        ]);
    }
}
