@component('mail::message')
Dear <strong>Sir</strong>,

New Mobilization request has been made.
The details of the request are: <br>

@component('mail::panel')

<div class="row">
    <div class="col-md-6">
        <div>
            Reference number: {{ $mobreq->refnumb }}
        </div>
        <div>
            Member Company: {{ $mobreq->membcomp }}
        </div>
        <div>
            Notifier: {{ $mobreq->notifier }}
        </div>
        <div>
            Designation: {{ $mobreq->designation!=''?$mobreq->designation:'N/A' }}
        </div>
        <div>
            Direct Phone: {{ $mobreq->directphone!=''?$mobreq->directphone:'N/A' }}
        </div>
        <div>
            Mobile Phone: {{ $mobreq->mobilephone }}
        </div>
        <div>
            Email: {{ $mobreq->email }}
        </div>
        <div>
            Centre Number: {{ $mobreq->centrenumb!=''?$mobreq->centrenumb:'N/A' }}
        </div>
        <div>
            Activation Date: {{ $mobreq->dateofact }}
        </div>
        <div>
            Activation Time: {{ $mobreq->timeofact }}
        </div>
        <div>
            Date of Spill: {{ $mobreq->spilldate }}
        </div>
        <div>
            Spill Time: {{ $mobreq->spilltime!=''?$mobreq->spilltime:'N/A' }}
        </div>
        <div>
            Spill Source: {{ $mobreq->spillsource!=''?$mobreq->spillsource:'N/A' }}
        </div>
        <div>
            Spill Cause: {{ $mobreq->spillcause!=''?$mobreq->spillcause:'N/A' }}
        </div>

    </div>
    <div class="col-md-6">
        <div>
            Location: {{ $mobreq->location!=''?$mobreq->location:'N/A' }}
        </div>
        <div>
            Town: {{ $mobreq->town!=''?$mobreq->town:'N/A' }}
        </div>
        <div>
            Spill Status: {{ $mobreq->spillstatus }}
        </div>
        <div>
            Production Type: {{ $mobreq->productiontype!=''?$mobreq->productiontype:'N/A' }}
        </div>
        <div>
            Facility: {{ $mobreq->facility!=''?$mobreq->facility:'N/A' }}
        </div>
        <div>
            Environment Type: {{ $mobreq->environmenttype }}
        </div>
        <div>
            Resources at risk: {{ $mobreq->res_at_risk!=''?$mobreq->res_at_risk:'N/A' }}
        </div>
        <div>
            Number of Personnel: {{ $mobreq->numofpersonnel }}
        </div>
        <div>
            Safety Info. 1: {{ $mobreq->safetyinfo1!=''?$mobreq->safetyinfo1:'N/A' }}
        </div>
        <div>
            Safety Info. 2: {{ $mobreq->safetyinfo2!=''?$mobreq->safetyinfo2:'N/A' }}
        </div>
        <div>
            Added Info.: {{ $mobreq->addedinfo!=''?$mobreq->addedinfo:'N/A' }}
        </div>
        <div>
            Provision(s): {{ $mobreq->provision }}
        </div>
        <div>
            Welfare Provision(s).: {{ $mobreq->welfareprov!=''?$mobreq->welfareprov:'N/A' }}
        </div>
    </div>
</div>

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

