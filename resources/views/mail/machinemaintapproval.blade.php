@component('mail::message')
Dear <strong>{{ $maintenance->user->firstname.' '.$maintenance->user->lastname }}</strong>,

Your periodic maintenance has been approved.
The maintenance details are: <br>

@component('mail::panel')
   <div>
    Maintenance Unique Number : {{ $maintenance->uniquenumb }}
   </div>
   <div>
    Maintained Machine : {{ $maintenance->schedule->machine->name }}
   </div>
   <div>
    Machine Location: {{ $maintenance->schedule->machine->location->name }}
   </div>
   
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent