@component('mail::message')
Dear <strong>Cyril Ezeaku</strong>, <br>

<strong>{{ $schedule->user->firstname.' '.$schedule->user->lastname }}</strong>

A machine has been scheduled by <strong>{{ $schedule->user->firstname.' '.$schedule->user->lastname }}</strong>  and it is waiting for approval.

The schedule details are: <br>

@component('mail::panel')
   <div>
    Schedule Unique Number : {{ $schedule->uniquenumb }}
   </div>
   <div>
    Scheduled Machine : {{ $schedule->machine->name }}
   </div>
   <div>
    Machine Location : {{ $schedule->machine->location->name }}
   </div>
   <div>
    Schedule Type :  {{$schedule->schedtype->name}}
   </div>
   <div>
    Next Maintenance Period : {{ $schedule->nextmaintperiod>1? $schedule->nextmaintperiod.' months': $schedule->nextmaintperiod.' month' }}
   </div>
   
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent