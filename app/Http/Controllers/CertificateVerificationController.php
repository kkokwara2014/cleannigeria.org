<?php

namespace App\Http\Controllers;

use App\Models\Trainingcert;
use Illuminate\Http\Request;

class CertificateVerificationController extends Controller
{
    

    public function verifycertificateform(){
        return view('frontend.certificate.verify');
    }

    public function checkcertificate(Request $request){
        $this->validate($request,[
            'certnumber'=>'required'
        ]);      

        $certnumber=$request->certnumber;

        $approvedcertificates=Trainingcert::with('trainee')->where(function ($query) use ($certnumber) {
            $query->where('certnumber','=',$certnumber);
        })->get();

            if(count($approvedcertificates) > 0){
                return view('frontend.certificate.verify', compact('approvedcertificates'))
                ->withDetails($approvedcertificates)->withQuery($certnumber);
                    
            }else{
                    return view('frontend.certificate.verify', compact('approvedcertificates'))
                ->withMessage('The Certificate number you supplied does not exist. Please search again! 😦');
            }

        
    }


    public function downloadtraineecertificate($filename){
        $file = public_path('storage/trainee_certificates/'.$filename);
        $name = basename($file);
        return response()->download($file, $name);
    }
}
