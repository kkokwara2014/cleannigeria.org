<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Maintenance Request</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
   
        <div style="text-align: center">
            <img src="{{ asset('bootstrap_assets/images/LOGO.png') }}" width="70" height="70">
        </div>

        <h3>
            Notifier :
            <strong>{{ $maintrequest->user->firstname.' '.$maintrequest->user->lastname }}</strong>
            &nbsp;
            <small>[{{ $maintrequest->jobdesignation }}]</small>
        </h3>

        <div>
           @if ($maintrequest->isapproved==1)
               <strong>Approved</strong>
               
                                by <strong>{{ $approver->firstname.' '.$approver->lastname }}</strong>
           @else
                <strong>Not Approved</strong>
           @endif
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4><strong>Contact Details</strong></h4>
                <div>
                    Maintenance Code : #{{ $maintrequest->maintcode }}
                </div>
                <div>
                    Member Company : {{ $maintrequest->membercompany }}
                </div>
                <div>
                    Direct phone : <a
                        href="tel:{{ $maintrequest->directphone }}">{{ $maintrequest->directphone }}</a>
                </div>
                <div>
                    Email Address : <a
                        href="mailto:{{ $maintrequest->email }}">{{ $maintrequest->email }}</a>
                </div>
                <hr>
                <h4><strong>Equipment Details</strong></h4>
                <div>
                    Date of Request : {{ $maintrequest->dateofrequest }}
                </div>
                <div>
                    Equipment type : {{ $maintrequest->equipmenttype }}
                </div>
                <div>
                    Equipment location : {{ $maintrequest->equipmentlocation }}
                </div>
                <div>
                    Maintenance type : {{ $maintrequest->mainttype }}
                </div>
                <div>
                    Equipment Fault : {{ $maintrequest->equipmentfault }}
                </div>
                <div>
                    Maintained before? :
                    @if ($maintrequest->cmdonebefore=='Yes')
                    <span class="badge badge-success badge-pill"
                        style="background-color: green; color:seashell">{{ $maintrequest->cmdonebefore }}</span>
                    @else
                    <span class="badge badge-danger badge-pill"
                        style="background-color: crimson; color:seashell">{{ $maintrequest->cmdonebefore }}</span>


                    @endif

                </div>
                <div>
                    Spare part available? :
                    @if ($maintrequest->sparepartavailable=='Yes')
                    <span class="badge badge-success badge-pill"
                        style="background-color: green; color:seashell">{{ $maintrequest->sparepartavailable }}</span>
                    @else
                    <span class="badge badge-danger badge-pill"
                        style="background-color: crimson; color:seashell">{{ $maintrequest->sparepartavailable }}</span>
                    @endif
                </div>
                <div>
                    SRE Maint. in place? :
                    @if ($maintrequest->sremaintinplace=='Yes')
                    <span class="badge badge-success badge-pill"
                        style="background-color: green; color:seashell">{{ $maintrequest->sremaintinplace }}</span>
                    @else
                    <span class="badge badge-danger badge-pill"
                        style="background-color: crimson; color:seashell">{{ $maintrequest->sremaintinplace }}</span>
                    @endif
                </div>
                <div>
                    Expected Maintenance date :
                    {{ date('d M, Y',strtotime($maintrequest->expectedmaintdate)) }}
                </div>
                <hr>
            </div>
            <div class="col-md-6">
                <h4><strong>Health, Safety & Environment</strong></h4>
                <div style="text-align: justify">
                    HSE Risk Description :
                    {{ $maintrequest->hseriskdesc }}
                </div>
                <div style="text-align: justify">
                    Security Risk Description :
                    {{ $maintrequest->secriskdesc }}
                </div>
                <div style="text-align: justify">
                    Security Arrangement Description :
                    {{ $maintrequest->secarrangementdesc }}
                </div>
                <hr>
                <h4><strong>Additional Information</strong></h4>
                <div style="text-align: justify">
                    {{ $maintrequest->moreinfo }}
                </div>
                <div>
                    @if ($maintrequest->covidppe!=NULL)
                    {{ $maintrequest->covidppe }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->accomodation!=NULL)
                    {{ $maintrequest->accomodation }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->safetyoflocation!=NULL)
                    {{ $maintrequest->safetyoflocation }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->armedsecurity!=NULL)
                    {{ $maintrequest->armedsecurity }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->transportation!=NULL)
                    {{ $maintrequest->transportation }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->communiservices!=NULL)
                    {{ $maintrequest->communiservices }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->incidentsiteaccess!=NULL)
                    {{ $maintrequest->incidentsiteaccess }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->medicalservice!=NULL)
                    {{ $maintrequest->medicalservice }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->welfare!=NULL)
                    {{ $maintrequest->welfare }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
                <div>
                    @if ($maintrequest->safetycriticaldevice!=NULL)
                    {{ $maintrequest->safetycriticaldevice }} &nbsp;
                    <span class="fa fa-check"></span>
                    @endif
                </div>
            </div>
        </div>
    
        
                    
       
    
</body>
</html>