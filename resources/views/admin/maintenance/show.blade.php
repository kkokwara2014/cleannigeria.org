@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('maintenance.index') }}" class="btn btn-success btn-sm">
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
                                <img src="{{url('user_images',$maint->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250">

                                <p>
                                    <h3>{{$maint->user->firstname.' '.$maint->user->lastname}}
                                    </h3>
                                    <small><span class="fa fa-briefcase"></span> {{ $maint->user->role->name }}</small>
                                </p>
                                <hr>
                                <div><span class="fa fa-envelope"></span> {{$maint->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$maint->user->phone}}</div>

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
                            <div class="col-md-10">



                                <hr>

                                <div>Equipment Name:  {{$maint->srequipment->name}} </div>
                                <div>Maintenance Cycle:  {{$maint->maintcycle}}</div>
                                <div>Last Maint. Date: {{$maint->lastmaintdate}}</div>
                                <div>Next Maint. Date: {{$maint->nextmaintdate}}</div>
                                <div>Activity Description: {{$maint->activitydescription}}</div>
                                <div>
                                    Approved?
                                    @if ($maint->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                </div>
                                <div>
                                    Confirmed?
                                    @if ($maint->isconfirmed==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Confirmed</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Confirmed</span>

                                        @endif
                                </div>
                                <br>
                                <div>
                                    @if ($maint->isapproved==1)
                                    Approver:
                                        <strong>{{ $approvedby->user->firstname.' '.$approvedby->user->lastname }}</strong>

                                    @endif
                                </div>
                                <div>
                                    @if ($maint->isconfirmed==1)
                                    Confirmed by:
                                        <strong>{{ $confirmedby->user->firstname.' '.$confirmedby->user->lastname }}</strong>

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
