@component('mail::message')

Dear <strong>Sir</strong>, <br>
Your Staff <strong>{{ $staff_firstname.' '.strtoupper($staff_lastname) }}</strong> has uploaded Master Document Register (MDR)  for your approval. The details of the document include: <br>

<div>
    Document Title : <strong>{{ $doctitle }}</strong>
</div>
<div>
    Document Number : <strong>{{ $docnumber }}</strong>
</div>
<div>
    Date uploaded: {{ $created_at }}
</div>

<br><br>
Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent
