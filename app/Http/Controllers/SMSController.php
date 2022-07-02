<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    

    public static function sendLeaveApplicationToStaffSMS($leave){
        $approver=User::find($leave->sendto_id);

        $the_approver=$approver->firstname.' '.$approver->lastname;

        $message=urlencode("Dear ".$leave->user->firstname. ", your leave application has been sent to ".$the_approver." for approval. You will be notified upon its approval. Thank you.");
        $sender=urlencode("CNA Leave");
        $recipient=urlencode($leave->user->phone);

        Self::sendsms($recipient,$sender,$message);
    }
    public static function sendLeaveApplicationToApproverSMS($leave){
        $approver=User::find($leave->sendto_id);

        $the_applicant=$leave->user->firstname.' '.$leave->user->lastname;

        $message=urlencode("Dear ".$approver->firstname. ", your staff ".$the_applicant." has applied for leave. Kindly visit www.cleannigeria.org to consider approval . Thank you.");
        $sender=urlencode("CNA Leave");
        $recipient=urlencode($approver->phone);

        Self::sendsms($recipient,$sender,$message);
    }

    public static function sendLeaveApprovalToStaffSMS($leave){
        // $approver=User::find($leave->sendto_id);
        $message=urlencode("Dear ".$leave->user->firstname. ", your leave application has been approved. Congratulations!.");
        $sender=urlencode("CNA Leave");
        $recipient=urlencode($leave->user->phone);

        Self::sendsms($recipient,$sender,$message);
    }

    //for competence assessment
    public static function sendComptassApplicationToStaffSMS($comptass){
        $approver=User::find($comptass->sentto_id);

        $the_staff=User::find($comptass->user_id);

        $the_approver=$approver->firstname.' '.$approver->lastname;

        $message=urlencode("Dear ".$the_staff->firstname. ", your Competence Assessment application has been sent to ".$the_approver." for approval. You will be notified upon its approval. Thank you.");
        $sender=urlencode("CNA Comptass");
        $recipient=urlencode($the_staff->phone);

        Self::sendsms($recipient,$sender,$message);
    }
    public static function sendComptassApplicationToApproverSMS($comptass){
        $approver=User::find($comptass->sentto_id);
        $the_staff=User::find($comptass->user_id);

        $the_applicant=$the_staff->firstname.' '.$the_staff->lastname;

        $message=urlencode("Dear ".$approver->firstname. ", your staff ".$the_applicant." has filled Competence Assessment form. Kindly visit www.cleannigeria.org to consider approval . Thank you.");
        $sender=urlencode("CNA Comptass");
        $recipient=urlencode($approver->phone);

        Self::sendsms($recipient,$sender,$message);
    }

    public static function sendHazardReportToStaffSMS($hazardreport){
        $approver=User::find($hazardreport->sentto_id);

        $the_approver=$approver->firstname.' '.$approver->lastname;

        $message=urlencode("Dear ".$hazardreport->user->firstname. ", your hazard report has been sent to ".$the_approver." for necessary action!. Thank you.");
        $sender=urlencode("CNA Hazard");
        $recipient=urlencode($hazardreport->user->phone);

        Self::sendsms($recipient,$sender,$message);
    }
    public static function sendHazardReportToApproverSMS($hazardreport){
        $approver=User::find($hazardreport->sentto_id);

        $the_applicant=$hazardreport->user->firstname.' '.$hazardreport->user->lastname;

        $message=urlencode("Dear ".$approver->firstname. ", your staff ".$the_applicant." has reported hazard incident. Kindly visit www.cleannigeria.org for necessary action . Thank you.");
        $sender=urlencode("CNA Hazard");
        $recipient=urlencode($approver->phone);

        Self::sendsms($recipient,$sender,$message);
    }

    //waybill sms
    public static function sendWaybillToStaffSMS($waybill){
        $approver=User::find($waybill->approver_id);

        $the_approver=$approver->firstname.' '.$approver->lastname;

        $message=urlencode("Dear ".$waybill->user->firstname. ", a waybill you created with ref #".$waybill->waybillnum." has been sent to ".$the_approver." for approval. Thank you.");
        $sender=urlencode("CNA Waybill");
        $recipient=urlencode($waybill->user->phone);

        Self::sendsms($recipient,$sender,$message);
    }
    public static function sendWaybillToApproverSMS($waybill){
        $approver=User::find($waybill->approver_id);

        $the_applicant=$waybill->user->firstname.' '.$waybill->user->lastname;

        $message=urlencode("Dear ".$approver->firstname. ", your staff ".$the_applicant." has created a waybill with ref #".$waybill->waybillnum." Kindly visit www.cleannigeria.org to consider approval . Thank you.");
        $sender=urlencode("CNA Waybill");
        $recipient=urlencode($approver->phone);

        Self::sendsms($recipient,$sender,$message);
    }


    //sending password to newly created CNA Partner
    public static function sendPasswordToNewPartnerBySMS($partner, $partner_password){
        $message=urlencode("Dear ".$partner->firstname.' '.$partner->lastname. ", your login details to CNA platform are your company email and ".$partner_password." as password. Visit www.cleannigeria.org/inventory/login to login and make equipment maintenance request.");
        $sender=urlencode("CNA Partner");
        $recipient=urlencode($partner->phone);

        Self::sendsms($recipient,$sender,$message);

        return;
    }


     
     public static function sendLoginCredentialBySMS($staff, $generated_password){
        $message=urlencode("Dear ".$staff->firstname.' '.$staff->lastname. ", your Staff Appraisal login details are ".$staff->staffnumb." and ".$generated_password." as Staff number and password respectively. Visit www.staffappraisal.org/login. Thank you.");
        $sender=urlencode("Appraisal");
        $recipient=urlencode($staff->phone);

        Self::sendsms($recipient,$sender,$message);

        
        // return back();
        return;
    }

    // the module for sendsms function
    public function sendsms($recipient,$sender,$message)
    {
        // $message=$message;
        // $sender=$sender;
        // $recipient=$recipient;
        
        $api_username="kkokwara2014@gmail.com";
        $api_password="@Victorkk1978Muna";
        $api_token="ba34f9e7e74fa61beaa22154082f29f472a559a6";
            

        $url='https://api.ebulksms.com:4433/sendsms?username='.$api_username.'&apikey='.$api_token.'&sender='.$sender.'&messagetext='.$message.'&flash=0&recipients='.$recipient.'';
        

        $isError = 0;
        $errorMessage = true;

        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);
        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);


        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }
}
