<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactStoreRequest;
use App\Notifications\ContactCNANotification;
use App\User;
use Illuminate\Http\Request;

class ContactusController extends Controller
{

    public function create(){
        return view('frontend.contact.create');
    }

    public function store(Request $request){

        $contact=new Contact;
        $contact->sender=$request->sender;
        $contact->email=$request->email;
        $contact->category=$request->category;
        $contact->subject=$request->subject;
        $contact->body=$request->body;
        $contact->save();

        //notify CNA email center
        // $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new ContactCNANotification($contact));

        return redirect()->back()->with('success','Message sent successfully. Thank you');
    }
}
