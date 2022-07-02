@component('mail::message')
Dear <strong>Sir/Madam</strong>,

<strong>{{ $contactus->sender  }}</strong> has sent a request via the contact form.
Details of the request/message are: <br>

@component('mail::panel')
   <div>
    Email Address: {{ $contactus->email }}
   </div>
   <div>
    Category: {{ $contactus->category }}
   </div>
   <div>
    Subject: {{ $contactus->subject }}
   </div>
   <div>
    Message body: {{ $contactus->body }}
   </div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
