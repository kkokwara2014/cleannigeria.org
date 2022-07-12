<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('bootstrap_assets/images/LOGO.png') }}">
  <title>Biometric Capture</title>
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
    <a href="" class="page-caption"><b>Bio</b> Capture</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body rounded-coners"> 
      <div class="success-img hide"><img src="{{asset('admin_assets/dist/img/success.png')}}" alt=""></div>
    <div class="card-body ">
        <input type="hidden" value="{{request()->query('user')}}" class="user_id" id="user_id" name="user_id">
        <div class="form-group row text-center justify-content-center">
            <div class="col-md-12">
                <div class="box capture-box" id="box1"></div>
                <button for="box1" type="button" class="btn btn-primary btn-sm capture" id="caputure1">Capture</button>
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




<script type="text/javascript" src="https://js.camsunit.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://js.camsunit.com/camsScanner.js"></script>
<script type="text/javascript">
    var lastClickedCaptureButtonId;
    var apiKey = '';

    $(document).ready(function(){

        $(this).on('click','.capture',function() {

                $(".result").html('');
                lastClickedCaptureButtonId = $(this).attr('for');
                $("#"+lastClickedCaptureButtonId ).css("background-image","");
                $("#"+lastClickedCaptureButtonId ).attr("tmpl","");
                $(this).attr('disabled', 'true');
                
                var returnPNGImage = true; // returns PNG image along with the template. Setting it to false, returns only template

                $.get("{{route('cam.key')}}").done(function(key){
                    apiKey = key;
                    capture(apiKey, returnPNGImage);
                })
                .error(function(err){
                    alert(err);
                });
                

        });

    });

    async function onSuccess(data)
    {

        var plainData = data;
        var successData = await getScannerSuccessData(plainData);

        if(successData.operation =="Capture")
        {

            var pngImageContent = "data:image/png;base64," + successData.image;
            var userId = $('.user_id').val();
            if(!userId || userId == 'select'){
                alert("User not selected. Please select a user to proceed");
                
                return;
            }
            $("#"+lastClickedCaptureButtonId ).css("background-image", "url('"+ pngImageContent + "')");
            $("#"+lastClickedCaptureButtonId ).attr("tmpl",successData.template);
            let url = "{{route('bio.store')}}";
            let urlData = url+'?user_id='+userId+'&template='+successData.template;
            

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                url: urlData,
                data: urlData,
                method: 'GET',
                success: function(data){
                    // alert(data);
                    $('.success-img').removeClass('hide');
                    console.log(data);
                    refeshPage();
                },
                error: function(error){
                    alert(error);
                    refeshPage()
                }
            });

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
        $("#error-text").html("Error </br> ["+failureData.errorCode+"] "+failureData.errorString);
    }
</script>
