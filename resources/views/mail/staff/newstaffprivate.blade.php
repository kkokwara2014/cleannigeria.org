@component('mail::message')
Dear <strong>{{ $user->firstname.' '.$user->lastname }}</strong>,

Your account has been created successfully on CNA Inventory platform.
Your account details are: <br>

@component('mail::panel')
   <div>
    Email: {{ $user->email }}
   </div>
   <div>
    Phone: {{ $user->phone }}
   </div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent