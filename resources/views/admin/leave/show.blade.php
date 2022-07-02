@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('leave.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="{{url('user_images',$leave->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250">

                                <p>
                                    <h2>{{$leave->user->firstname.' '.$leave->user->lastname}}
                                        <small>[{{ $leave->user->role->name }}]</small></h2>
                                </p>
                                <hr>

                                <div><span class="fa fa-envelope"></span> {{$leave->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$leave->user->phone}}</div>



                            </div>


                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">



                                <hr>

                                {{-- <div>Title:  {{$leave->title}} </div> --}}
                                <div>Leave Type:  {{$leave->leavetype->name}}</div>
                                <div>Starting Date: {{$leave->starting}}</div>
                                <div>Ending Date: {{$leave->ending}}</div>
                                <div>Number of Days: {{$leave->numofdays}}</div>
                                <div>Remaining Days: {{$leave->user->leaveent}}</div>
                                <div>Brief Description: {{$leave->description}}</div>
                                <div>
                                    Status:
                                    @if ($leave->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                </div>
                                <br>
                                <div>
                                    @if ($leave->isapproved==1)
                                    Approver:
                                        <strong>{{ $approvedby->user->firstname.' '.$approvedby->user->lastname }}</strong> <small>[{{ $approvedby->user->role->name }}]</small>

                                        @endif
                                </div>



                            </div>


                        </div>

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
