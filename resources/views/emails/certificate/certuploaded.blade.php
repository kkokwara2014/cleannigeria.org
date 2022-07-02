@component('mail::message')

Dear <strong>Sir</strong>, <br>
Your Staff <strong>{{ $staff_firstname.' '.strtoupper($staff_lastname) }}</strong> has uploaded trainee certificate  for your approval. The details of the certificate include: <br>

<div>
    Trainee Name : {{ $trainee_firstname.' '.strtoupper($trainee_lastname) }}
</div>
<div>
    Certificate Number : <strong>{{ $certnumber }}</strong>
</div>
<div>
    Training Name : {{ $training }}
</div>
<div>
    Date submitted: {{ $created_at }}
</div>
<hr>

<br><br>
The Trainee will be notified when the approval is done. Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent
