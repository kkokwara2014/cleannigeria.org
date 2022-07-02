@component('mail::message')
# Dear Sir,

A partner company maintenance request with the following details has been approved : 
<br>
<div>
    Maintenance request code: {{ $maintcode }}
</div>
<div>
    Notifier : <strong>{{ $notifier }}</strong>
</div>
<div>
    Member Company: {{ $membercompany }}
</div>
<div>
   Direct phone: {{ $directphone }}
</div>
<div>
   Date of Request: {{ $dateofrequest }}
</div>
<div>
   Equipment Type: {{ $equipmenttype }}
</div>
<div>
   Equipment Location: {{ $equipmentlocation }}
</div>
<div>
   Expected maintenance date: {{ date('d M, Y',strtotime($expectedmaintdate)) }}
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
