@component('mail::message')
Dear <strong>{{ $leave->user->firstname.' '.$leave->user->lastname }}</strong>,

Your leave application has been recieved and it is waiting for approval.
Your leave details are: <br>

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