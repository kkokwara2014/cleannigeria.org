<!DOCTYPE html>
<html>
  <head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel={ csrfToken:'{{csrf_token()}}' }
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>


    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('admin_assets/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet"
      href="{{asset('admin_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    

<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('admin_assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet"
      href="{{asset('admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
      href="{{asset('admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

      @livewireStyles
   
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>CNA</b> Inventory</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CNA Inventory</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              @impersonate()
                <li><a href="{{ route('staff.impersonate.destroy') }}">Stop Impersonating</a></li>
              @endimpersonate

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{url('user_images',$user->userimage)}}" class="user-image"
                    alt="User Image">
                  <span class="hidden-xs">{{Auth::user()->lastname.' '.Auth::user()->firstname}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{url('user_images',$user->userimage)}}" class="img-circle"
                      alt="User Image">

                    <p>
                      {{Auth::user()->lastname.' '.Auth::user()->firstname}} 
                      <small>Created {{Auth::user()->created_at->diffForHumans()}}</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="text-center">
                        <a href="{{ route('index') }}" style="color: #3468f7"><span class="fa fa-home"></span> cleannigeria.org</a>
                    </div>
                    <div class="pull-left">
                     @if ($user->profileupdated==1)
                     <a href="{{route('user.profile')}}" class="btn btn-default btn-flat">Profile</a>
                       
                     @endif
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
