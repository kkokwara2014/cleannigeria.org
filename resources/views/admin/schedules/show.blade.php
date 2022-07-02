@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('schedules.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="{{url('user_images',$schedule->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250" style="border-radius:50%">

                                <p>
                                    The schedule was done by
                                    <h3>{{$schedule->user->firstname.' '.$schedule->user->lastname}}
                                        <small>[{{ $schedule->user->role->name }}]</small>
                                    </h3>
                                </p>
                                <hr>

                                <div><span class="fa fa-envelope"></span> {{$schedule->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$schedule->user->phone}}</div>



                            </div>


                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-8">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <hr>

                                <div>Schedule Unique Number:  {{$schedule->uniquenumb }}</div>
                                <div>Scheduled Machine:  {{$schedule->machine->name}}</div>
                                <div>Schedule Type :  {{$schedule->schedtype->name}}</div>
                                <div>Next Maintainance period :  {{$schedule->nextmaintperiod>1? $schedule->nextmaintperiod.' months': $schedule->nextmaintperiod.' month'}}</div>
                                
                                <div>
                                    Status :
                                    @if ($schedule->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                    @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                    @endif
                                </div>
                                <div>
                                    Maintained? :
                                    @if ($schedule->ismaintained==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Yes</span>
                                    @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> No</span>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    @if ($schedule->isapproved==1)
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
