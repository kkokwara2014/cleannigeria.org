<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Report</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

</head>
<body>
   
        <div style="text-align: center">
            <img src="{{ asset('bootstrap_assets/images/LOGO.png') }}" width="70" height="70">
        </div>
    
        <div style="margin-bottom: 2%; height:5px;"></div>
        <!-- <hr> -->
        <table id="example1" class="table table-responsive table-bordered table-striped">
            <thead>
                <tr class="bg-navy">
                    <th colspan="@if ($for_period !='yearly') 6 @else 6 @endif">&nbsp</th>
                    <th>Total Man Hour</th>
                    <th>{{$manhour}} hr(s)</th>                                                                     
                </tr>
                <tr>
                    <th>S/N</th>
                    <th>Firstname</th>                                   
                    <th>Lastname</th>                                   
                    <th>Location</th>                                   
                    <th>Cloked In</th>                                   
                    <th>Cloked Out</th>                                                                    
                    <th>Duration In Mins</th>                                   
                    <th>Duration In Hours</th>                        
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($timesheet as $item)

                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->user->firstname}}</td>
                    <td>{{$item->user->lastname}}</td>
                    <td>{{$item->user_location}}</td>
                    <td>{{$item->clocked_in}}</td>
                    <td>{{$item->clocked_out}}</td>
                    <td>{{$item->duration}} min(s)</td>
                    <td>{{ round($item->duration / 60, PHP_ROUND_HALF_UP) }} hr(s)</td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>S/N</th>
                    <th>Firstname</th>                                   
                    <th>Lastname</th>                                   
                    <th>Location</th>                                   
                    <th>Cloked In</th>                                   
                    <th>Cloked Out</th>                                                                    
                    <th>Duration In Mins</th>                                   
                    <th>Duration In Hours</th>  
                </tr>
            </tfoot>
        </table>

        <!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>