<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Share</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap_assets/css/bootstrap.css') }}" rel="stylesheet">

    <!--font awesome-->
    <link href="{{ asset('bootstrap_assets/css/font-awesome.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Social Share Links</h2>
    
        
           @foreach ($socialshares as $key => $value)
               <div>
                   <a href="{{ $value }}" target="_blank"><span class="fa fa-{{ $key }}"></span> &nbsp; {{ ucfirst($key) }}</a>
               </div>
           @endforeach

           <br>
           <a href="{{ route('index') }}" class="btn btn-primary btn-sm">Return to Cleannigeria.org (CNA)</a>
        
    </div>
</body>
</html>