@component('mail::message')

Dear <strong>{{$assessor_firstname.' '.$assessor_lastname}}</strong>, <br>
Competence Assessment of <strong>{{ $firstname.' '.$lastname }}</strong> has been 
assessed.
Details of the Competence Assessment include: <br>

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
You are expected to complete your own assessment. Thank you.
<br>
<br>
Individual Competence Assessment Team.
@endcomponent