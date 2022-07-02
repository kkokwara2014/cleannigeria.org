@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('machines.index') }}" class="btn btn-success btn-sm">
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
                                <img src="{{url('user_images',$machine->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250" style="border-radius:50%">

                                <p>
                                    <br>
                                    This machine was added by: 
                                    <h3>{{$machine->user->firstname.' '.$machine->user->lastname}}
                                        <small>[{{ $machine->user->role->name }}]</small></h3>
                                </p>
                                <hr>

                                <div><span class="fa fa-envelope"></span> {{$machine->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$machine->user->phone}}</div>



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

                                <div>Auto-generated Unique Number:  {{$machine->uniquenumb }}</div>
                                <div>Machine Name:  {{$machine->name}}</div>
                                <div>Machine Status:  {{$machine->status}}</div>
                                <div>Located in :  {{$machine->location->name}}</div>
                                <br>
                                <div>
                                    <div class="panel-group" id="accordion"> 
                                        <div class="panel panel-default"> 
                                            <div class="panel-heading"> 
                                                <h4 class="panel-title"> 
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <span class="fa fa-info-circle"></span> Before Usage Information 
                                                    </a> 
                                                </h4> 
                                            </div> 
                                            <div id="collapseOne" class="panel-collapse collapse"> 
                                                <div class="panel-body"> 
                                                    <p style="text-align:justify">
                                                        {{ $machine->beforeuse }}
                                                    </p>
                                                </div> 
                                            </div> 
                                        </div> 
                                        <div class="panel panel-default"> 
                                            <div class="panel-heading"> 
                                                <h4 class="panel-title"> 
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="fa fa-info-circle"></span> After Usage Information </a> 
                                                </h4> 
                                            </div> 
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p style="text-align:justify">
                                                        {{ $machine->afteruse }}
                                                    </p>
                                                </div> 
                                                </div> 
                                            </div> 
                                            
                                        </div>
                                    
                                </div>
                                <hr>
                                <div>
                                    <h3>Maintenance Schedule</h3>
                                    <div class="panel-group" id="accordion"> 
                                        <div class="panel panel-default"> 
                                            <div class="panel-heading"> 
                                                <h4 class="panel-title"> 
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseMonthly"><span class="fa fa-info-circle"></span> Monthly <small>[Every month or every 50hrs]</small></a> 
                                                </h4> 
                                            </div> 
                                            <div id="collapseMonthly" class="panel-collapse collapse"> 
                                                <div class="panel-body"> 
                                                    <p style="text-align:justify">
                                                        {{ $machine->monthly }}
                                                    </p>
                                                </div> 
                                                </div> 
                                            </div> 
                                            <div class="panel panel-default"> 
                                                <div class="panel-heading"> 
                                                    <h4 class="panel-title"> 
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseQuarterly"><span class="fa fa-info-circle"></span> Quarterly <small>[Every 3 months or every 50hrs]</small></a> 
                                                    </h4> 
                                                </div> 
                                                <div id="collapseQuarterly" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <p style="text-align:justify">
                                                            {{ $machine->quarterly }}
                                                        </p>    
                                                    </div> 
                                                </div> 
                                            </div> 
                                            <div class="panel panel-default"> 
                                                <div class="panel-heading"> 
                                                    <h4 class="panel-title"> 
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSemiannually"><span class="fa fa-info-circle"></span> Semiannually <small>[Every 6 months or every 400hrs]</small></a> 
                                                    </h4> 
                                                </div> 
                                                <div id="collapseSemiannually" class="panel-collapse collapse"> 
                                                    <div class="panel-body"> 
                                                        <p style="text-align:justify">
                                                            {{ $machine->semiannually }}
                                                        </p>    
                                                    </div> 
                                                </div> 
                                            </div> 
                                            <div class="panel panel-default"> 
                                                <div class="panel-heading"> 
                                                    <h4 class="panel-title"> 
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseAnnually"><span class="fa fa-info-circle"></span> Annually <small>[Every year or every 1000hrs]</small></a> 
                                                    </h4> 
                                                </div> 
                                                <div id="collapseAnnually" class="panel-collapse collapse"> 
                                                    <div class="panel-body"> 
                                                        <p style="text-align:justify">
                                                            {{ $machine->annually }}
                                                        </p>    
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>
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
