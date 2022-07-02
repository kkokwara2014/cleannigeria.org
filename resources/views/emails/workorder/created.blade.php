@component('mail::message')
Dear <strong>Sir</strong>, <br>

A staff <strong>{{ $workordersender }}</strong>, <br>
has raised a work order. The details are: <br>

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
    Date Created : {{ $created_at }}
</div>

<hr>
<br>
Thank you.
<br>
<br>
{{ config('app.name') }}
@endcomponent