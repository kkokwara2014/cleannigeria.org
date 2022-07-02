<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobilizationStoreRequest;
use App\Mail\MobrequestMail;
use App\Models\Mobilizationrequest;
use App\Notifications\MobilizationCNANotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MobrequestController extends Controller
{

    public function create()
    {
        return view('frontend.mobilizationrequest.create');
    }

    public function store(Request $request){

        $refnumb = 'MOB-REQ-' . rand(301, 397) . rand(445, 525);
        $provision = implode(',', $request->provision);

        $mobreq=new Mobilizationrequest;
        $mobreq->refnumb=$refnumb;
        $mobreq->membcomp=$request->membcomp;
        $mobreq->notifier=$request->notifier;
        $mobreq->designation=$request->designation;
        $mobreq->directphone=$request->directphone;
        $mobreq->mobilephone=$request->mobilephone;
        $mobreq->email=$request->email;
        $mobreq->centrenumb=$request->centrenumb;
        $mobreq->dateofact=$request->dateofact;
        $mobreq->timeofact=$request->timeofact;
        $mobreq->spilldate=$request->spilldate;
        $mobreq->spilltime=$request->spilltime;
        $mobreq->spillsource=$request->spillsource;
        $mobreq->spillcause=$request->spillcause;
        $mobreq->location=$request->location;
        $mobreq->town=$request->town;
        $mobreq->spillstatus=$request->spillstatus;
        $mobreq->productiontype=$request->productiontype;
        $mobreq->facility=$request->facility;
        $mobreq->environmenttype=$request->environmenttype;
        $mobreq->res_at_risk=$request->res_at_risk;
        $mobreq->numofpersonnel=$request->numofpersonnel;
        $mobreq->safetyinfo1=$request->safetyinfo1;
        $mobreq->safetyinfo2=$request->safetyinfo2;
        $mobreq->safetyinfo3=$request->safetyinfo3;
        $mobreq->safetyinfo4=$request->safetyinfo4;
        $mobreq->addedinfo=$request->addedinfo;
        $mobreq->provision=$provision;
        $mobreq->welfareprov=$request->welfareprov;
        $mobreq->save();

        //notify CNA email center
        $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new MobilizationCNANotification($mobreq));

        //sending mails to CNA Staff
        foreach (['cyril.ezeaku@cleannigeria.org','etiese.etuk@cleannigeria.org','nosa.erhabor@cleannigeria.org','maxmilian.nwosu@cleannigeria.org','mfon.edet@cleannigeria.org','lawrence.obi@cleannigeria.org','brownson.digika@cleannigeria.org','emmanuel.aghaunor@cleannigeria.org','chester.iyama@cleannigeria.org','ralph.uwhumiakpor@cleannigeria.org'] as $recipient) {
            // Mail::to($recipient)->send(new MobrequestMail($mobreq));
        }

        //notify the sender
        // Notification::send($request->email, new MobilizationNotification($mobreq));


        return redirect()->back()->with('success','Mobilization Request with ref. ' . $mobreq->refnumb . ' has been sent successfully!');
    }
}
