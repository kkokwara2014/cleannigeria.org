<?php

namespace App\Http\Controllers;

use App\Mail\Maintrequestapprovalmail;
use App\Mail\Maintrequestmail;
use App\Mail\PartnerCreationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    
    public static function sendMaintenanceRequestMail($email, $maintrequest){
        Mail::to($email)->send(new Maintrequestmail($maintrequest));
    }
    public static function sendMaintenanceRequestApprovalMail($email, $maintrequest){
        Mail::to($email)->send(new Maintrequestapprovalmail($maintrequest));
    }
    public static function sendEmailToNewPartner($partner,$partner_password){
        Mail::to([$partner,'kkokwara2014@gmail.com'])->send(new PartnerCreationMail($partner,$partner_password));
    }
}
