@component('mail::message')
Dear <strong>{{ $trainee_firstname.' '.strtoupper($trainee_lastname) }}</strong>, <br>
Your training e-Certificate has been approved. The details of the certificate include: <br>

<div>
    Training Name : <strong>{{ $training }}</strong>
</div>
<div>
    Certificate Number : <strong>{{ $certnumber }}</strong>
</div>

<hr>
<br>
Kindly click <a target="_blank" href="https://www.cleannigeria.org/verify/certificate">here</a> to verify and download a copy. Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent


