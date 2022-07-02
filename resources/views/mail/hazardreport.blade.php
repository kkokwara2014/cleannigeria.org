@component('mail::message')
Dear <strong>{{ $receipient->firstname.' '.$receipient->lastname }}</strong>,

<strong>{{ $hreport->user->firstname.' '.$hreport->user->lastname }}'s</strong> hazard report requires your attention.
 The hazard report details are as follows: <br>

@component('mail::panel')
   <div>
    Report Number: {{ $hreport->uniquenum }}
   </div>
   <div>
    Risk Category: {{ $hreport->riskcategory }}
   </div>
   <div>
    Description: {{ $hreport->description }}
   </div>
   <div>
    Date/Time of Occurence: {{ $hreport->dateofoccurence.' '.$hreport->timeofoccurence }}
   </div>
   <div>
    Date/Time of Reporting: {{ $hreport->dateofreporting.' '.$hreport->timeofreporting }}
   </div>
   <div>
    Location: {{ $hreport->location->name }}
   </div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent