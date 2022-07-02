<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->profileupdated==1) {
            $user=Auth::user();
            $contacts=Contact::latest()->get();
            return view('admin.contact.index',compact('contacts','user'));
            
        } else {
            return redirect()->route('access.denied');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        if (Auth::user()->profileupdated==1) {
            $contact=Contact::find($contact->id);
            return view('admin.contact.show', array('user' => Auth::user()), compact('contact'));
        }else{
            return redirect()->route('access.denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if (Auth::user()->profileupdated==1 && (Auth::user()->hasAnyRole(['Admin'])||Auth::user()->hasAnyRole(['General Manager']))) {
        $contact->delete();

        return redirect()->back()->with('deleted','Contact message deleted successfully!');
        }else{
            return redirect()->route('access.denied');
        }
    }
}
