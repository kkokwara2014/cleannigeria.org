@extends('admin.layout.app')

@section('title')
Partner Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('cnapartners.index') }}" class="btn btn-success btn-sm">
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
                                <img src="{{url('user_images',$partner->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250"
                                    style="border-radius: 50%">

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
                                <h3>

                                    Partner Details

                                </h3>
                                <hr>
                                <h2><strong>{{$partner->firstname.' '.$partner->lastname}}</strong></h2>

                                <div><span class="fa fa-envelope"></span> {{$partner->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$partner->phone}}</div>
                                <div><span class="fa fa-th"></span> {{$partner->staffcategory->name}}</div>
                                <div><span class="fa fa-map-marker"></span> {{$partner->location->name}}</div>
                                <div><span class="fa fa-clock-o"></span>
                                    {{$partner->created_at->diffForHumans().' on '.date('D d F, Y h:ia',strtotime($partner->created_at))}}
                                    [Date Created]</div>
                                <div>
                                    Status :
                                    @if ($partner->isactive==1)
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell"> Active</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: crimson; color:seashell"> Inactive</span>

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


        {{-- for partner maintenance request statistics --}}
        @if ($partner->staffcategory_id==3)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Maintenance request by
                                    <strong>{{ $partner->firstname.' '.$partner->lastname }}</strong>
                                    {{-- <span class="badge badge-pill badge-primary">{{ $usermaintrequest->maintrequests->count() }}</span>
                                    --}}
                                </h3>
                                <hr>

                                @forelse ($usermaintrequest->maintrequests as $maintreq)

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="{{ route('maintenancerequest.show',$maintreq->id) }}"
                                            title="Click to see details">
                                            #{{ $maintreq->maintcode }} &nbsp;
                                            {{ $maintreq->equipmenttype.' in '.$maintreq->equipmentlocation }} &nbsp;
                                            to be maintained on {{ date('d M, Y',strtotime($maintreq->expectedmaintdate)) }} &nbsp;
                                            &nbsp;
                                            @if ($maintreq->isapproved==1)
                                            <span class="badge badge-success badge-pill"
                                                style="background-color: green; color:seashell"> Approved</span>
                                            @else
                                            <span class="badge badge-danger badge-pill"
                                                style="background-color: crimson; color:seashell"> Not Approved</span>

                                            @endif
                                        </a>

                                    </div>
                                </div>
                                @empty
                                <span style="background-color: red; color: seashell">
                                    Partner has not made any Maintenance request.
                                </span>
                                @endforelse


                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        @endif



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