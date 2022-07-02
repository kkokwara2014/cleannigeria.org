@component('mail::message')

Dear <strong>{{$assessor_firstname.' '.$assessor_lastname}}</strong>, <br>
A Staff has submitted Competence Assessment form for your assessment. The details of the form include: <br>

<div>
    Staff Name : {{ $firstname.' '.$lastname }}
</div>
<div>
    Staff Phone : {{ $staffphone }}
</div>
<div>
    Competence Assessment Title: {{ $title }}
</div>
<div>
    Date submitted: {{ $created_at }}
</div>
<hr>

<br><br>
The Staff will be notified when you complete the assessment. Thank you.
<br>
<br>
Individual Competence Assessment Team.
@endcomponent

