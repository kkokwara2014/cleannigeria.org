@component('mail::message')
Dear <strong>{{ $srequipment->user->firstname.' '.$srequipment->user->lastname  }}</strong>,

The new SR Equipment created by you has been approved. 
The details of the equipment are: <br>

@component('mail::panel')
   <div>
    Reference number: {{ $srequipment->refnumb }}
   </div>
   <div>
    Equipment name: {{ $srequipment->name }}
   </div>
   <div>
    Quantity: {{ $srequipment->qty }}
   </div>
   <div>
    Status: {{ $srequipment->status }}
   </div>
   <div>
    Store: {{ $srequipment->store->name }}
   </div>
   <div>
    Equipment Category: {{ $srequipment->category->name }}
   </div>
   <hr>
   <h3>Supplier Details</h3>
   <div>
    Name: {{ $srequipment->supplier->name }}
   </div>
   <div>
    Phone: {{ $srequipment->supplier->phone }}
   </div>
   <div>
    Email Address: {{ $srequipment->supplier->email }}
   </div>
   <div>
    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent