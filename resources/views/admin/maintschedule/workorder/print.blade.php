<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Print Work Order</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    </head>

    <body>
        <div style="text-align: center">
            <img src="{{ asset('bootstrap_assets/images/LOGO.png') }}" width="70" height="70">
        </div>

        <div>
            <h4> Equipment/Work Order Information</h4>
            <div>Work Order Number: <strong>#{{ $workorder->uniquecode }}</strong></div>
            <div>Equipment : {{ $workorder->srequipment->name }}</div>
            <div>Equipment Location : {{ $workorder->srequipment->store->location->name }}
            </div>
            <div>Maintenance Due Date : {{ $workorder->duedateformaint }}</div>
            <div>Work Order Amount : <strong>=N={{ number_format($workorder->amount,2) }}</strong></div>
            <div>Description : {{ $workorder->description }}</div>
        </div>
        <div>
            <h4> Vendor Information</h4>
            <div>
                Name : {{ $workorder->vendor->vendorname }}
            </div>
            <div>
                Vendor Phone : {{ $workorder->vendor->vendorphone }}
            </div>
            <div>
                Vendor Address : {{ $workorder->vendor->vendoraddress }}
            </div>
        </div>

        <br>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div>
                    Created By:
                    <strong>{{ $workorder->user->firstname.' '.$workorder->user->lastname .' - '.$workorder->user->phone}}</strong>
                </div>
                <div>
                    <span class="fa fa-briefcase"></span> {{ $workorder->user->role->name }}
                </div>
                <div>
                    Created : {{ $workorder->created_at }}
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    Approver : <strong>{{ $approver->firstname.' '.$approver->lastname }}</strong>
                </div>
                <div>
                    <span class="fa fa-phone"></span> {{ $approver->phone }}
                </div>
                <div>
                    @if ($workorder->isapproved1==0)
                        <span class="badge badge-pill badge-primary"
                        style="background-color: red; color:whitesmoke"><span
                            class="fa fa-check-o"></span> 
                            Not Approved!
                        </span>

                    @elseif($workorder->isapproved1==1)
                        <hr>
                        
                        <span class="badge badge-pill badge-primary"
                        style="background-color: green; color:whitesmoke"><span
                            class="fa fa-check-o"></span> 
                            Approved!
                        </span>
                        
                            <div>
                                Comment : {{ $workorder->firstapprovercomment }}
                            </div>
                            <div>
                                Date : {{ $workorder->firstapproveddate }}
                            </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    Final Approver : <strong>{{ $finalapprover->firstname.' '.$finalapprover->lastname }}</strong>
                </div>
                <div>
                    <span class="fa fa-phone"></span> {{ $finalapprover->phone }}
                </div>
                <div>
                    @if ($workorder->isapproved1==1 && $workorder->isapproved2==0)
                    <span class="badge badge-pill badge-primary"
                        style="background-color: red; color:whitesmoke"><span
                            class="fa fa-check-o"></span> 
                            Not Approved!
                        </span>

                    @elseif($workorder->isapproved2==1)
                        <hr>
                        
                        <span class="badge badge-pill badge-primary"
                        style="background-color: green; color:whitesmoke"><span
                            class="fa fa-check-o"></span> 
                            Approved!
                        </span>
                        
                            <div>
                                Comment : {{ $workorder->secondapprovercomment }}
                            </div>
                            <div>
                                Date : {{ $workorder->secondapproveddate }}
                            </div>
                    @endif
            </div>
        </div>


        <!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    </body>

</html>