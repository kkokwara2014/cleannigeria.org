<?php

namespace App\Http\Controllers;


use App\Models\Trainee;
use App\Models\Trainingcert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateCertificateController extends Controller
{

    public function generatecertificate($certfilename){
        // header('content-type:image/jpeg');

        $cert=Trainingcert::where('filename',$certfilename)->first();
        
        // $font=public_path('arial.ttf');
        // $font2=public_path('AUNTJUDY.TTF');
        // $certificate=public_path('cna_certificate.jpg');
        // $image=imagecreatefromjpeg($certificate);

        // $color=imagecolorallocate($image, 51, 51, 102);
        
        // $startingdate=date('d M, Y',strtotime($cert->training->startdate));
        // imagettftext($image,18,0,130,455,$color,$font,$startingdate);
        
        // $endingdate=date('d M, Y',strtotime($cert->training->enddate));
        // imagettftext($image,18,0,400,455,$color,$font,$endingdate);
        
        // $name=$cert->trainee->firstname.' '.($cert->trainee->othername!=' '?ucfirst($cert->trainee->othername):' ').' '.$cert->trainee->lastname;
        // imagettftext($image,32,0,60,297,$color,$font2,$name);

        // $endingdate=date('d M, Y',strtotime($cert->issuedon));
        // imagettftext($image,15,0,330,620,$color,$font,$endingdate);

        // $certnumber=$cert->certnumber;
        // imagettftext($image,15,0,390,662,$color,$font,$certnumber);

        // imagejpeg($image);

        // imagedestroy($image);

        //send email to the trainee
        $traincert=Trainingcert::where('filename',$certfilename)->first();
        $trainees=Trainee::latest()->get();

        foreach ($trainees as $trainee) {
            if ($trainee->id==$traincert->trainee_id && $certfilename==$traincert->filename) {
                // Mail::to($trainee->email)->send(new TrainingCertificateMail($trainee, $traincert));
            }
        }

        return view('admin.traineecertificate.certificate.displaycert',array('user'=>Auth::user()),compact('cert'));
    }
}
