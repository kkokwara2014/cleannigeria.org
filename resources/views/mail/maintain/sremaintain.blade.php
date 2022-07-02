@component('mail::message')
Dear <strong>Sir/Madam</strong>,

SR Equipment has been maintained by <strong>{{ $maintenance->user->firstname.' '.$maintenance->user->lastname  }}</strong>. 
The details of the maintenance are: <br>

@component('mail::panel')
   <div>
    SRE Ref. number: {{ $maintenance->srequipment->refnumb }}
   </div>
   <div>
    Equipment name: {{ $maintenance->srequipment->name }}
   </div>
   <div>
    Maintenance Date: {{ $maintenance->maintdate }}
   </div>
   <div>
    Next Maintenance Date: {{ $maintenance->nextmaintdate }}
   </div>
   <div>
    Action Required: {{ $maintenance->actionreq }}
   </div>
   <div>
    Action Taken: {{ $maintenance->actiontaken }}
   </div>
   
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent