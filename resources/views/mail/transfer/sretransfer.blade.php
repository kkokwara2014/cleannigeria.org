@component('mail::message')
Dear <strong>Sir/Madam</strong>,

SR Equipment has been transferred by <strong>{{ $transfer->user->firstname.' '.$transfer->user->lastname  }}</strong>. 
The details of the transfer are: <br>

@component('mail::panel')
   <div>
    SRE Ref. number: {{ $transfer->srequipment->refnumb }}
   </div>
   <div>
    Equipment name: {{ $transfer->srequipment->name }}
   </div>
   <div>
    Quantity: {{ $transfer->qty }}
   </div>
   <div>
    Destination: {{ $transfer->to_location->name }}
   </div>    
   <div>
    Reason: {{ $transfer->reason }}
   </div>    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent