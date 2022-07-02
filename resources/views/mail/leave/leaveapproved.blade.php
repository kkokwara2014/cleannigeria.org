@component('mail::message')
Dear <strong>{{ $leave->user->firstname.' '.$leave->user->lastname }}</strong>,

Your leave application has been approved.
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

You may proceed on leave.

Thanks,<br>
{{ config('app.name') }}
@endcomponent