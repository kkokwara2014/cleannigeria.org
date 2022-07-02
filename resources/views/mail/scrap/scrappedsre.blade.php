@component('mail::message')
Dear <strong>Sir/Madam</strong>,

SR Equipment has been scrapped by <strong>{{ $scrap->user->firstname.' '.$scrap->user->lastname  }}.</strong>
The details of the scrapped equipment are: <br>

@component('mail::panel')
   <div>
    SRE Ref. number: {{ $scrap->srequipment->refnumb }}
   </div>
   <div>
    Equipment name: {{ $scrap->srequipment->name }}
   </div>
   <div>
    Equipment Category: {{ $scrap->srequipment->category->name }}
   </div>
   <div>
    Quantity: {{ $scrap->qty }}
   </div>
   <div>
    Reason: {{ $scrap->reason }}
   </div>
   
    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent