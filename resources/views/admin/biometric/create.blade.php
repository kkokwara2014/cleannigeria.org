@extends('admin.layout.app')

@section('title')
    Biometric Capture
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/bioStyle.css')}}">
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('bio.home') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> View Captured List
            </a>
        </p>

        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body ">
                        
                        <form action="" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">User</label>
                                        <select name="user_id" class="user_id form-control" required>
                                            <option value="select" selected="disabled">Select User</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="box capture-box" id="box1"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>

                            <button for="box1" type="button" class="btn btn-primary btn-sm capture" id="caputure1">Capture</button>
                            <button type="reset" class="btn btn-success btn-sm">Reset Form</button>
                        </form>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            
        </div>


    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    {{-- <section class="col-lg-5 connectedSortable"> --}}


    {{-- </section> --}}
    <!-- right col -->
</div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('scripts')
<script type="text/javascript" src="https://js.camsunit.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://js.camsunit.com/camsScanner.js"></script>
	  <script type="text/javascript">
         var lastClickedCaptureButtonId;
         var apiKey = 'UFFOG8KSVFvCnsOVw5XCm8OZGRvDjcKSTB7DlBXClMONDRReVhNaw5BSXk7DnFAbw5FNGhUNwpjDkcOTwpjDmBTDkcOZFcOTwpPCncKeXMOLXMKMwpNbw5ETwpNdFcONwpnDmlFcWQ7CkcOSW8OSFMKQw4vCnMONDsOTUxROUhEVHsOMwpAMTFvDjAxSFMKeHsObHEzCnB3CmV5TDcKbFsKcThoUFMKSwphdwpkOFV3DnMKVFcONHsOME1ZVTsKWw4vCnMOSHFlMXMKdThIWFsKZUFUZwpDDjRvDi8Kbw5DClBrDmlrDncKeFRHCmhIOw4vCmsOYw5weU01REcKaw43DlcOLw4tcGhNVw4tcERXDmBIZw5BSDFXDkcKRXsKVwpYZFBrCjcKMwp1Vw5INGsOcwp4bw5MawpXCmMKMFsOUwpEUThRNwpMbwpxVHV5bw5BaE1YRGVJMw5DCmsOTVcOdDhxVDMKaFcKRwpFWw5nCmE1awp3DmsOdDMKSwpPCmFpUGcOMwo3CjMKYDE3DlE0dTMKbw5pOUsOcwpZMwpxREcOSG1HDjUzCkBtVHg3DlFrDi1kSw53DnF3CjFVSw5QWDsOUWk5awpHCmcKeDMKNw5RRUMOSw5jCnMKRw5DDjcKVVMONVQ7CkBkdwp7DmsOLTg7CnRnDnFHCnVAaUsKYw5DDlcObHlkbWxZYXcOaw5tUHVvDk1rDncOMwpMRw43CkcOUUsKbwpbDjMOREsKbHBrDmsKVwp7Dk1lMHsOdwpIVUV7CjMKRUsKTw4pYw4tOwpoOw4oMVRbDi0xVwpLClsKew5DDk8OQFMKew5FeFsKZUFEcUBJdwpXDmcKTThvDlMKZwpPCnsKYwo0Nw5sZwp3Di13CmxHDjR1Ywp7CmsOQEQzDmRlMwpjDlMKVw5FUwo1RWMOcE8OZwpIRw5UTG8OdTx3ClcKSXcONUhbCnl4Vw5XDlcKdw5TDk8Odw5jDlcKWVcORw51PT8KVAkFBWXU=';

         $(document).ready(function(){

               $(this).on('click','.capture',function() {

                        $(".result").html('');
                        lastClickedCaptureButtonId = $(this).attr('for');
                        $("#"+lastClickedCaptureButtonId ).css("background-image","");
                        $("#"+lastClickedCaptureButtonId ).attr("tmpl","");
                     
                        var returnPNGImage = true; // returns PNG image along with the template. Setting it to false, returns only template

                        capture(apiKey, returnPNGImage);

               });

         });

         function onSuccess(data)
         {

            var plainData = data;
            var successData = getScannerSuccessData(plainData);

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
                        alert(data);
                        console.log(data);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });

            }
                    
         }

         function onFailure(data)
         {
            var failureData = getScannerFailureData(data);
            //console.log(failureData.opeartion);

            $("#error-text").html("Error </br> ["+failureData.errorCode+"] "+failureData.errorString);
            $('f1score').html('');
            $('f2score').html('');

         }
      </script>
@endsection
