@component('mail::message')
Dear <strong>Sir</strong>, <br>

A staff by name <strong>{{ $workordersender }}</strong>, <br>
has raised a work order and has been approved. The details are: <br>

<div>
    Work Order Number : <strong>{{ $workordernumber }}</strong>
</div>
<div>
    Equipment : {{ $workordersre }}
</div>
<div>
    Work order Amount : <strong>=N={{ number_format($workorderamount,2) }}</strong>
</div>
<div>
    Work order Description : {{ $workorderdescription }}
</div>
<div>
    Approver : <strong>{{ $approver }}</strong>
</div>
<div>
    Comment : {{ $firstapprovercomment }}
</div>
<div>
    Approval Date : {{ $approvaldate }}
</div>

<hr>
<br>
Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent


