@component('mail::message')

Dear <strong>{{$firstname.' '.$lastname}}</strong>, <br>
Thank you for submitting your Competence Assessment form. The details of the form include: <br>

<div>
    Competence Assessment Title: {{ $title }}
</div>
<div>
    Date submitted: {{ $created_at }}
</div>
<hr>
<div>
    Assessor : {{ $assessor_firstname.' '.$assessor_lastname }}
</div>

<br><br>
Your Assessor has been notified and you shall be notified also when you have been assessed. Thank you.
<br>
<br>
Individual Competence Assessment Team.
@endcomponent

