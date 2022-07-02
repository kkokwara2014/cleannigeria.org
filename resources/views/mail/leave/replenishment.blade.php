@component('mail::message')
Dear <strong>Sir/Madam</strong>,

SR Equipment has been replenished by <strong>{{ $replenish->user->firstname.' '.$replenish->user->lastname  }}</strong>. 
The details of the equipment are: <br>

@component('mail::panel')
   <div>
    Equipment name: {{ $replenish->srequipment->name }}
   </div>
   <div>
    Quantity: {{ $replenish->qty }}
   </div>
   <div>
    
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent