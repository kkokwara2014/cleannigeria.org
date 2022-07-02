@component('mail::message')
Dear <strong>{{ $receipient->firstname.' '.$receipient->lastname }}</strong>,

<strong>{{ $leave->user->firstname.' '.$leave->user->lastname }}'s</strong> leave application is waiting for approval.
 The leave details are as follows: <br>

@component('mail::panel')
   <div>
    Leave type: {{ $leave->leavetype->name }}
   </div>
   <div>
    Stating: {{ $leave->starting }}
   </div>
   <div>
    Ending: {{ $leave->ending }}
   </div>
   <div>
    Number of days: {{ $leave->numofdays }}
   </div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent