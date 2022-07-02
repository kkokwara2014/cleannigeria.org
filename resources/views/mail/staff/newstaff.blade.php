@component('mail::message')
The account of <strong>{{ $user->firstname.' '.$user->lastname }}</strong>
 has been created successfully on CNA Inventory platform.<br>

 Staff details are:

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