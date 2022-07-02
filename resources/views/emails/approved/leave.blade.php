@component('mail::message')
Dear <strong>Sir</strong>, <br>

A leave request has been approved for <strong>{{ $leave->user->firstname.' '.$leave->user->lastname }}</strong>. <br>
The details of the leave are: <br>

<div>
    Leave Type : {{ $leave->leavetype }}
</div>
<div>
    Number of days Requested : {{ $leave->numofdays }}
</div>
<div>
    Starting : {{date('d M, Y',strtotime($leave->starting))}}
</div>
<div>
    Ending : {{date('d M, Y',strtotime($leave->ending))}}
</div>
<div>
    Requested on : {{date('d M, Y',strtotime($leave->created_at))}}
</div>
<div>
    Approved on : {{date('d M, Y',strtotime($leave->updated_at))}}
</div>

<hr>
<br>
Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent



