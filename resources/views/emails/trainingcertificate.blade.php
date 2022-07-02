@component('mail::message')
Dear <strong>{{ $trainee_firstname.' '.strtoupper($trainee_lastname) }}</strong>, <br>
Your training e-Certificate has been approved. The details of the certificate include: <br>

<div>
    Training Name : <strong>{{ $training }}</strong>
</div>
<div>
    Certificate Number : <strong>{{ $certnumber }}</strong>
</div>

<br>
Kindly download the attached file. Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent