@component('mail::message')
Dear <strong>Sir/Madam</strong>,

SR Equipment has been unscrapped by <strong>{{ $unscrap->user->firstname.' '.$unscrap->user->lastname  }}.</strong>
The details of the unscrapped equipment are: <br>

@component('mail::panel')
   <div>
    SRE Ref. number: {{ $unscrap->srequipment->refnumb }}
   </div>
   <div>
    Equipment name: {{ $unscrap->srequipment->name }}
   </div>
   <div>
    Equipment Category: {{ $unscrap->srequipment->category->name }}
   </div>
   <div>
    Quantity: {{ $unscrap->qty }}
   </div>
   
    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent