<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Waybill</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

</head>
<body>
   
        <div style="text-align: center">
            <img src="{{ asset('bootstrap_assets/images/LOGO.png') }}" width="70" height="70">
        </div>
    

        <div>
            <h5>Vehicle number: {{ $waybill->vehiclenum }}</h5>
            <div class="row">
                <div class="col-md-6">
                    From: {{ $waybill->waybilllocation->name }}
                </div>
                <div class="col-md-6">
                    To: {{ $waybill->destination }}
                </div>
            </div>
            
            <div>
                Created on : {{ date('d M, Y.',strtotime($waybill->created_at)) }}
            </div>
            <div class="row" style="font-weight: bold">
                <div class="col-md-4">
                    Creator: {{ $waybill->user->firstname.' '.$waybill->user->lastname }}
                </div>
                <div class="col-md-4">
                    Receiver: {{ $waybill->receiver->firstname.' '.$waybill->user->lastname }}
                </div>
                <div class="col-md-4">
                    Approver: {{ $waybill->approver->firstname.' '.$waybill->user->lastname }}
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-light table-striped">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($waybill->waybillitems as $waybillitem)
                    <tr>
                        <td>{{ $waybillitem->waybill->waybillnum }}</td>
                        <td>{{ $waybillitem->issuenum }}</td>
                        <td>{{ $waybillitem->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                    
       
    
        <!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>