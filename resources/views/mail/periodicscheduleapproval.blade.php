@component('mail::message')
Dear <strong>{{ $schedule->user->firstname.' '.$schedule->user->lastname }}</strong>,

Your periodic maintenance schedule has been approved.
Your schedule details are: <br>

@component('mail::panel')
   <div>
    Schedule Unique Number : {{ $schedule->uniquenumb }}
   </div>
   <div>
    Scheduled Machine : {{ $schedule->machine->name }}
   </div>
   <div>
    Machine Location: {{ $schedule->machine->location->name }}
   </div>
   
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent