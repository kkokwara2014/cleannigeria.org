@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('machinemaints.index') }}" class="btn btn-success btn-sm">
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
                                <img src="{{url('user_images',$machinemaint->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250" style="border-radius:50%">

                                <p>
                                    <br>
                                    This machine maintenance was done by: 
                                    <h3>{{$machinemaint->user->firstname.' '.$machinemaint->user->lastname}}
                                        <small>[{{ $machinemaint->user->role->name }}]</small></h3>
                                </p>
                                <hr>

                                <div><span class="fa fa-envelope"></span> {{$machinemaint->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$machinemaint->user->phone}}</div>



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

                                <div>Auto-generated Unique Number:  {{$machinemaint->uniquenumb }}</div>
                                <div>Scheduled Machine:  {{$machinemaint->schedule->machine->name}}</div>
                                <div>machinemaint Status:  {{$machinemaint->schedule->machine->status}}</div>
                                <div>Located in :  {{$machinemaint->schedule->machine->location->name}}</div>
                                <div>Maintenance Due Time :  {{$machinemaint->schedule->nextmaintperiod>1? $machinemaint->schedule->nextmaintperiod.' months': $machinemaint->schedule->nextmaintperiod.' month'}}</div>
                                <br>
                                <div>
                                    <div class="panel-group" id="accordion"> 
                                        <div class="panel panel-default"> 
                                            <div class="panel-heading"> 
                                                <h4 class="panel-title"> 
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <span class="fa fa-info-circle"></span> Action Taken 
                                                    </a> 
                                                </h4> 
                                            </div> 
                                            <div id="collapseOne" class="panel-collapse collapse"> 
                                                <div class="panel-body"> 
                                                    <p style="text-align:justify">
                                                        {{ $machinemaint->actiontaken }}
                                                    </p>
                                                </div> 
                                            </div> 
                                        </div> 
                                        <div class="panel panel-default"> 
                                            <div class="panel-heading"> 
                                                <h4 class="panel-title"> 
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="fa fa-info-circle"></span> Recommendation</a> 
                                                </h4> 
                                            </div> 
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p style="text-align:justify">
                                                        {{ $machinemaint->recommendation }}
                                                    </p>
                                                </div> 
                                                </div> 
                                            </div> 
                                            
                                        </div>
                                    
                                </div>
                                <hr>

                                <div>
                                    @if ($machinemaint->isapproved==1)
                                    Status :
                                    <span class="badge badge-success badge-pill"
                                    style="background-color: green; color:seashell"> Approved</span>
                                    @else
                                    Status :
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                    @endif
                                </div>
                                <div>
                                    @if ($machinemaint->ismaintained==1)
                                    Maintained? :
                                    <span class="badge badge-success badge-pill"
                                    style="background-color: green; color:seashell"> Yes</span>
                                    @else
                                    Maintained? :
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> No</span>
                                    @endif
                                </div>
                                <br>
                                <div>
                                    @if ($machinemaint->isapproved==1)
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
