<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use App\Models\Training;
use App\Models\Trainingcert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TrainingcertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates=Trainingcert::latest()->get();
        return view('admin.traineecertificate.certificate.index',array('user'=>Auth::user()),compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generatedcode=rand(23,99).bin2hex(random_bytes(2));
        $trainees=Trainee::orderBy('firstname','asc')->get();
        $trainings=Training::orderBy('name','asc')->get();
        return view('admin.traineecertificate.certificate.create',array('user'=>Auth::user()),compact('trainees','trainings','generatedcode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'certnumber'=>'required|min:13|unique:trainingcerts',
            'issuedon'=>'required',
            'certfilename' => 'required',
            'certfilename.*' => 'mimes:pdf'
        ]);


        //uploading certificate 
        // if ($request->hasFile('certfilename')) {
            
        //         $certfile=$request->uniquecode.'.'.$request->certfilename->getClientOriginalExtension();
        //         $request->certfilename->storeAs('public/trainee_certificates/', $certfile);
                
                $certi=new Trainingcert();
                $certi->trainee_id=$request->trainee_id;
                $certi->training_id=$request->training_id;
                $certi->user_id=$request->user_id;
                $certi->certnumber=$request->certnumber;
                $certi->uniquecode=$request->uniquecode;
                $certi->issuedon=$request->issuedon;
                $certi->validityperiod=$request->validityperiod;
                // $certi->filename=$certfile;
                
                $certi->save();

                //generate the certificate
                header('content-type:image/jpeg');

        $cert=Trainingcert::where('uniquecode',$certi->uniquecode)->first();
        
        $font=public_path('arial.ttf');
        $font2=public_path('AUNTJUDY.TTF');
        $certificate=public_path('cna_certificate.jpg');
        $image=imagecreatefromjpeg($certificate);

        $color=imagecolorallocate($image, 51, 51, 102);
        
        $startingdate=date('d M, Y',strtotime($cert->training->startdate));
        imagettftext($image,18,0,130,380,$color,$font,$startingdate);
        
        $endingdate=date('d M, Y',strtotime($cert->training->enddate));
        imagettftext($image,18,0,330,380,$color,$font,$endingdate);
        
        $name=$cert->trainee->firstname.' '.($cert->trainee->othername!=' '?ucfirst($cert->trainee->othername):' ').' '.$cert->trainee->lastname;
        imagettftext($image,32,0,60,250,$color,$font2,$name);

        $training_name=$cert->training->name;
        imagettftext($image,19,0,50,325,$color,$font,$training_name);

        $endingdate=date('d M, Y',strtotime($cert->issuedon));
        imagettftext($image,15,0,280,518,$color,$font,$endingdate);

        $certnumber=$cert->certnumber;
        imagettftext($image,15,0,320,550,$color,$font,$certnumber);

        $filename='trainingcert_'.$certi->uniquecode.'.jpg';

        // Storage::disk('public')->url('generatedcerts/'.$filename);

        public_path('generatedcerts/'.$filename);
        
        //save the generated certificate
        imagejpeg($image, $filename);

        //saving the filename in database
        $cert->filename=$filename;
        $cert->save();

        imagedestroy($image);

                
                //send email to GM for approval
                $creatorInfo=User::find($certi->user_id);
                $receipientGM=User::where('role_id','1')->orWhere('role_id','2')->first();
                
                // Mail::to($receipientGM->email)->send(new CertificateUploadedMail($certi, $creatorInfo));
            // }

        return redirect()->route('certificates.index')->with('success','New Certificate add successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certi=Trainingcert::where('id',$id)->first();

        return view('admin.traineecertificate.certificate.viewcert',array('user'=>Auth::user()),compact('certi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deleting  file from the database
        $certi=Trainingcert::find($id);
        $certi->delete();

        //deleting certificate files from folder
        // File::delete([public_path('storage/trainee_certificates/' . $certi->filename)]);
        File::delete([public_path($certi->filename)]);

        //redirecting page
        return redirect()->back()->with('deleted','Certificate with number '.$certi->certnumber.' deleted successfully!');
    }

    public function approve($id){
        $cert=Trainingcert::find($id);
        $cert->isapproved='1';
        $cert->save();

        //send email to the trainee
        // $trainee=Trainee::find($cert->trainee_id);       
        
        // Mail::to($trainee->traineeemail)->send(new CertificateApprovedMail($cert));

        return back()->with('success', 'Certificate has been approved successfully!');
    }

    public function certificatefiledownload($filename){
        $file = public_path('storage/trainee_certificates/'.$filename);
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function generatecert($certfilename){
        header('content-type:image/jpeg');

        $cert=Trainingcert::where('filename',$certfilename)->first();
        
        $font=public_path('arial.ttf');
        $font2=public_path('AUNTJUDY.TTF');
        $certificate=public_path('cna_certificate.jpg');
        $image=imagecreatefromjpeg($certificate);

        $color=imagecolorallocate($image, 51, 51, 102);
        
        $startingdate=date('d M, Y',strtotime($cert->training->startdate));
        imagettftext($image,18,0,130,380,$color,$font,$startingdate);
        
        $endingdate=date('d M, Y',strtotime($cert->training->enddate));
        imagettftext($image,18,0,350,380,$color,$font,$endingdate);
        
        $name=$cert->trainee->firstname.' '.($cert->trainee->othername!=' '?ucfirst($cert->trainee->othername):' ').' '.$cert->trainee->lastname;
        imagettftext($image,32,0,60,297,$color,$font2,$name);

        $endingdate=date('d M, Y',strtotime($cert->issuedon));
        imagettftext($image,15,0,300,550,$color,$font,$endingdate);

        $certnumber=$cert->certnumber;
        imagettftext($image,15,0,390,662,$color,$font,$certnumber);

        imagejpeg($image);

        imagedestroy($image);

        //send email to the trainee
        $traincert=Trainingcert::where('filename',$certfilename)->first();
        $trainees=Trainee::latest()->get();

        foreach ($trainees as $trainee) {
            if ($trainee->id==$traincert->trainee_id && $certfilename==$traincert->filename) {
                // Mail::to($trainee->email)->send(new TrainingCertificateMail($trainee, $traincert));
            }
        }
           
    }
}
