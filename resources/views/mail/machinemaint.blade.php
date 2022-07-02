@component('mail::message')
Dear <strong>Cyril Ezeaku</strong>, <br>

<strong>{{ $maintenance->user->firstname.' '.$maintenance->user->lastname }}</strong>

A maintenance report has been created by <strong>{{ $maintenance->user->firstname.' '.$maintenance->user->lastname }}</strong>  and it is waiting for approval.

The maintenance details are: <br>

@component('mail::panel')
   <div>
    Maintenance Unique Number : {{ $maintenance->uniquenumb }}
   </div>
   <div>
    Maintained Machine : {{ $maintenance->schedule->machine->name }}
   </div>
   <div>
    Machine Location : {{ $maintenance->schedule->machine->location->name }}
   </div>
   <div>
    Maintenance Start Date :  {{$maintenance->startdate}}
   </div>
   <div>
    Maintenance End Date :  {{$maintenance->enddate}}
   </div>
   <div>
    Action taken : {{ $maintenance->actiontaken }}
   </div>
      
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent