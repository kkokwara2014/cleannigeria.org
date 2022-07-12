<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">
  <title>Time System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('login_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('login_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('login_assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('login_assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('login_assets/plugins/iCheck/square/blue.css')}}">

  <link rel="stylesheet" href="{{asset('admin_assets/dist/css/bioStyle.css')}}">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page timesys-bg">
<div class="login-box">

  <div class="login-logo">
    <a href="" class="page-caption"><b>Time</b> System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body rounded-coners"> 
      <div class="success-img hide "><img src="{{asset('admin_assets/dist/img/success.png')}}" alt=""></div>
    <div class="card-body ">
        <input type="hidden" value="{{request()->query('location')}}" id="user_location" name="user_location">
        <div class="form-group row text-center justify-content-center">
            <div class="col-md-12">
                <div class="box capture-box" id="box2"></div>
                <button for="box2" type="button" class="capture btn btn-success" id="caputure2">Scan</button>
            </div>
            </div>
        </div>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('login_assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('login_assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('login_assets/plugins/iCheck/icheck.min.js') }}"></script>

</body>
</html>




<script type="text/javascript" src="https://js.camsunit.com/camsScanner.js"></script>
<script type="text/javascript">
    var lastClickedCaptureButtonId;
    var usersBio;
    var indexPosition = 0;
    var objectLength;
    var apiKey = '';

    $(document).ready(function(){
        $(this).on('click','.capture',function() {

            $(".result").html('');
            lastClickedCaptureButtonId = $(this).attr('for');
            $("#"+lastClickedCaptureButtonId ).css("background-image","");
            $("#"+lastClickedCaptureButtonId ).attr("tmpl","");
            var returnPNGImage = true; // returns PNG image along with the template. Setting it to false, returns only template
            $(this).attr('disabled', 'true');
            
            $.get("{{route('cam.key')}}").done(function(key){
                apiKey = key;
                // console.log(returnPNGImage);
                capture(apiKey, returnPNGImage);
            });

        });

    });

    async function fireCompare() {
        $(".result").html('');
        $.get("{{route('bio.all')}}")
        .done(function(data){
             localStorage.setItem('bios', data);
        });

        var dataObj = await JSON.parse(localStorage.getItem('bios'));
        if(dataObj.length){
            myCompare();
        }
        else{
            alert("Your record does not exist. Please contact admin for bio capturing.");
        }
    };

    function myCompare()
    {
        var temlate1 = $("#box2").attr('tmpl');       
        var dataObj = JSON.parse(localStorage.getItem('bios'));
        var temlate2 = dataObj[indexPosition].template;

        $.get("{{route('cam.key')}}").done(function(key){
            apiKey = key;
            compare(apiKey,temlate1,temlate2);
        });
    }

    function onSuccess(data)
    {
        var plainData = data;
        var successData = getScannerSuccessData(plainData);
        console.log(successData);

        if(successData.operation =="Capture"){
            captureSuccess(successData)
        }

        if(successData.operation =="Compare")
        {
            compareSuccess(successData)
        }

    }

    async function compareSuccess(data)
    {
        var successData = data;
        var score = await successData.matchScore;
        var dataObj = await JSON.parse(localStorage.getItem('bios'));
        objectLength = dataObj.length;

        if(score > 0){
            $("#score").text("Score: "+score);
            updateUserLocation(dataObj[indexPosition]);
            indexPosition = indexPosition + 1;
            $('.success-img').removeClass('hide');
            refeshPage();
        }
        else{
            indexPosition = indexPosition + 1;

            if(indexPosition <= objectLength - 1){
                myCompare();
            }
            else{
                alert('No match found');
                refeshPage();
            }
        }
        
    }

    function updateUserLocation(data)
    {

        let userLocation = $('#user_location').val();
        $.get("{{route('biotimesys.store')}}", {user_id: data.user_id, location_id: userLocation})
        .done(function(response){
            console.log(response);
            // alert(response.message+', your location has been captured;');
        });
    }

    async function captureSuccess(data)
    {
       await console.log(data);
       var successData = data;
       var pngImageContent = "data:image/png;base64," + successData.image;

        $("#"+lastClickedCaptureButtonId ).css("background-image", "url('"+ pngImageContent + "')");
        $("#"+lastClickedCaptureButtonId ).attr("tmpl",successData.template);
        let template = await $("#"+lastClickedCaptureButtonId ).attr("tmpl");

        if(template){
            const compare = await fireCompare();
        } 
    }

    function refeshPage()
    {
        setTimeout(function(){
            location.reload(true);
        }, 2000);
    }

    function onFailure(data)
    {
        var failureData = getScannerFailureData(data);
        console.log("Error </br> ["+failureData.errorCode+"] "+failureData.errorString);

    }
</script>
