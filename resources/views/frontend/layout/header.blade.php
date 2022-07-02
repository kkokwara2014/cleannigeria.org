<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">
        <title>@yield('title')</title>

        {{-- <script>
            window.menu = '$title';
        </script> --}}



        <!-- Bootstrap core CSS -->
        <link href="{{ asset('bootstrap_assets/css/bootstrap.css') }}" rel="stylesheet">

        <!--font awesome-->
        <link href="{{ asset('bootstrap_assets/css/font-awesome.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!--dataTable plugin-->
        <link href="{{ asset('bootstrap_assets/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

        <!-- Date Picker -->
        <link rel="stylesheet"
            href="{{asset('admin_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

        <link href="{{ asset('bootstrap_assets/css/myapp.css') }}" rel="stylesheet" type="text/css" />

        <!--jquery-->
        <script src="{{ asset('bootstrap_assets/js/jquery.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap_assets/js/bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap_assets/js/myapp.js') }}" type="text/javascript"></script>

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    </head>

    <body>

        <div class="wrapper">
            <!--navigation-->
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <!--Brand and toggle get grouped for better mobile display-->

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="{{ route('index') }}">
                            <!--<span style="font-family: fantasy; color: #398439; font-size: 25px;"> CNA</span>-->
                            <img class="img-responsive top" src="{{ asset('bootstrap_assets/images/LOGO.png') }}"
                                width="50" height="50" style="margin-top: -12px;" />
                        </a>
                    </div>

                    <!--Collect the nav links, forms, and other content for toggling-->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">

                            <!--<li><a href="#" data-toggle="modal" data-target="#activateCNAModal"><button style="margin-top: -2px; background-color: #ff0000; color: #fff;" class="btn btn-sm"> <strong>Activate CNA</strong></button></a></li>-->
                            <li><a href="{{ route('mobrequest') }}"><button
                                        style="margin-top: -2px; background-color: #ff0000; color: #fff;"
                                        class="btn btn-sm"> <strong>Activate CNA</strong></button></a></li>
                            <!--<li><a href="#" style="background-color: #ff0000; color: #fff; font-weight: bold;"><span class="fa fa-check-circle-o"></span>  Activate CNA</a></li>-->


                            <li class=""><a href="{{ route('index') }}"><span class="fa fa-home"></span> Home</a></li>

                            <li id="about" class="dropdown">

                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">About <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="{{ route('baseoperation') }}">Base Operation</a></li>
                                    <li class=""><a href="{{ route('membercompanies') }}">Our Members</a></li>
                                    <li class=""><a href="{{ route('cnaobjectives') }}">CNA Objectives</a></li>
                                    <li class=""><a href="{{ route('membership') }}">Membership</a></li>
                                    <li class=""><a href="{{ route('services') }}">Services</a></li>
                                    <li class=""><a href="{{ route('gallery') }}">Gallery</a></li>
                                    <li class=""><a href="{{ route('keystaff') }}">Key Staff</a></li>
                                    <!--<li class=""><a href="">Career</a></li>-->
                                </ul>
                            </li>

                            <!--<li class=""><a href="">Downloads</a></li>-->
                            <li class=""><a href="{{ route('governance') }}">Governance</a></li>
                            <li id="safetyculture" class="dropdown">

                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Safety Culture <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="{{ route('safetypolicies') }}">Policies</a></li>
                                </ul>
                            </li>

                            <li class=""><a href="{{ route('contactus') }}">Contact Us</a></li>

                            <li id="newsmedia" class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">News &AMP; Media <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="{{ route('events') }}">Events</a></li>
                                    <li class=""><a href="{{ route('news') }}">News</a></li>
                                    {{-- <li class=""><a href="{{ route('newsletter') }}">Newsletter</a></li> --}}
                                    <li class=""><a href="{{ route('mediares') }}">Media Resources</a></li>

                                </ul>
                            </li>

                            {{-- for certificate verification --}}
                            <li id="certificates" class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false"><sup><span style="color: red" class="fa fa-certificate"></span></sup> Certificates <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class=""><a href="{{ route('certificateverifyform') }}">Verify</a></li>
                                    
                                </ul>
                            </li>
                            

                            <li id="mycna" class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">MyCNA <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @if (auth()->check()))
                                    <li class=""><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                                    <li class=""><a href="{{route('logout')}}">Logout</a></li>
                                    @endif

                                    @if (!auth()->check())
                                    <li class=""><a href="{{ route('login') }}">Inventory</a></li>
                                    <li class=""><a href="https://premium51.web-hosting.com:2096/" target="_blank">Mails</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--carousel-->
            <div class="container" style="background-color: #fff;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 20px;">
                    <!--Indicators-->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                    </ol>

                    <!--Wrapper for slides-->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{ asset('bootstrap_assets/carouselimages/banner.jpg') }}" alt="First Slide"
                                class="img-responsive" width="100%">
                        </div>
                        <div class="item">
                            <img src="{{ asset('bootstrap_assets/carouselimages/banner3.jpg') }}" alt="Second Slide"
                                class="img-responsive" width="100%">
                        </div>
                        <div class="item">
                            <img src="{{ asset('bootstrap_assets/carouselimages/banner4.jpg') }}" alt="Third Slide"
                                class="img-responsive" width="100%">
                        </div>
                        <div class="item">
                            <img src="{{ asset('bootstrap_assets/carouselimages/banner5.jpg') }}" alt="Fouth Slide"
                                class="img-responsive" width="100%">
                        </div>
                        <div class="item">
                            <img src="{{ asset('bootstrap_assets/carouselimages/cna_banner.png') }}" alt="Fouth Slide"
                                class="img-responsive" width="100%">
                        </div>
                        <div class="item">
                            <img src="{{ asset('bootstrap_assets/carouselimages/banner6.jpg') }}" alt="Fouth Slide"
                                class="img-responsive" width="100%">
                        </div>
                    </div>

                    <!--Controls-->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!--navbar for social media icons-->
                <nav class="navbar navbar-default" role="navigation">

                    <div>

                        <ul class="nav navbar-nav navbar-right">
                            <li style="font-size:20px;">
                                <a href="https://www.linkedin.com/in/clean-nigeria-associates/" target="_blank"><span
                                        class="fa fa-linkedin-square" style="color: #398439; "></span></a>
                            </li>
                            <li style="font-size:20px;">
                                <a href="https://twitter.com/cleannigeriaas1" target="_blank"><span
                                        class="fa fa-twitter-square" style="color: #398439; "></span></a>
                            </li>
                            <li style="font-size:20px;">
                                <a href="https://www.facebook.com/cleannigeriaassociates.cna" target="_blank"><span
                                        class="fa fa-facebook-square" style="color: #398439; "></span></a>
                            </li>
                            <li style="font-size:20px;">
                                <a href="https://www.instagram.com/cleannigeriaassociates/" target="_blank"><span
                                        class="fa fa-instagram" style="color: #398439; "></span></a>
                            </li>
                            <li>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </li>
                        </ul>

                    </div>
                </nav>
                <!--</div>-->
            </div>

            <div class="content">
