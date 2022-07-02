@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a>
        <br><br>
        <div class="row">
            <div class="col-md-10">


                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>
                            <h3>{{ $srequipments->name }} Details</h3>
                        </p>
                        <hr>


                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"> <a href="#details" data-toggle="tab"> Details </a>
                            </li>
                            <li><a href="#creator" data-toggle="tab">Creator</a></li>
                            <li><a href="#supplier" data-toggle="tab">Supplier</a></li>
                            <li><a href="#moreinfo" data-toggle="tab">More Info</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div>
                                            Ref # : {{ $srequipments->refnumb }}
                                        </div>
                                        <div>
                                            Name : {{ $srequipments->name }}
                                        </div>
                                        <div>
                                            Matric. Number :
                                            {{ $srequipments->matricnumb!=''?$srequipments->matricnumb:'N/A' }}
                                        </div>
                                        <div>
                                            Serial Number :
                                            {{ $srequipments->serialnumb!=''?$srequipments->serialnumb:'N/A' }}
                                        </div>
                                        <div>
                                            Model Number :
                                            {{ $srequipments->modelnumb!=''?$srequipments->modelnumb:'N/A' }}
                                        </div>
                                        <div>
                                            Status :
                                            {{ $srequipments->status }}
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            Manufacturing Date :
                                            {{ $srequipments->manufacdate!=''?$srequipments->manufacdate:'N/A' }}
                                        </div>
                                        <div>
                                            Available Qty. : {{ $srequipments->qty}}
                                        </div>
                                        <div>
                                            Description :
                                            {{ $srequipments->description!=''?$srequipments->description:'N/A' }}
                                        </div>
                                        <div>
                                            Remarks : {{ $srequipments->remarks!=''?$srequipments->remarks:'N/A' }}
                                        </div>
                                        <div>
                                            Created :
                                            {{ $srequipments->created_at->diffForHumans() .' on '. date('D d F, Y h:ia',strtotime($srequipments->created_at)) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="creator">
                                <br>
                                <p>
                                    <div>
                                        <span class="fa fa-user"></span>
                                        {{ ucfirst($srequipments->user->firstname).' '.ucfirst($srequipments->user->lastname) }}
                                    </div>
                                    <div>
                                        <span class="fa fa-briefcase"></span> {{ $srequipments->user->role->name }}
                                    </div>

                                    <div>
                                        <span class="fa fa-phone"></span> {{ ucfirst($srequipments->user->phone) }}
                                    </div>
                                    <div>
                                        <span class="fa fa-envelope"></span> {{ ucfirst($srequipments->user->email) }}
                                    </div>
                                </p>

                            </div>
                            <div class="tab-pane fade" id="supplier">
                                <br>
                                <p>
                                    <div>
                                        <span class="fa fa-user"></span> {{ $srequipments->supplier->name }}
                                    </div>
                                    <div>
                                        <span class="fa fa-phone"></span> {{ $srequipments->supplier->phone }}
                                    </div>
                                    <div>
                                        <span class="fa fa-envelope"></span> {{ $srequipments->supplier->email }}
                                    </div>
                                    <div>
                                        <span class="fa fa-map-marker"></span> {{ $srequipments->supplier->address }}
                                    </div>

                                </p>

                            </div>
                            <div class="tab-pane fade" id="moreinfo">
                                <br>
                                <p>
                                    <div>
                                        <span class="fa fa-th"></span> {{ $srequipments->category->name }}
                                    </div>
                                    <div>
                                        <span class="fa fa-university"></span> {{ $srequipments->store->name }}
                                    </div>
                                    <div>
                                        <span class="fa fa-map-marker"></span> {{ $srequipments->store->location->name }}
                                    </div>
                                    <div>
                                        <span class="fa fa-archive"></span>  @if ($srequipments->isscrapped==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Scrapped</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Scrapped</span>

                                        @endif
                                    </div>
                                    <div>
                                        <span class="fa fa-exchange"></span>  @if ($srequipments->istransfered==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Transfered</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Transfered yet</span>

                                        @endif
                                    </div>
                                    <div>
                                        <span class="fa fa-wrench"></span>  @if ($srequipments->ismaintained==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Maintained</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> No Maintenance yet</span>

                                        @endif
                                    </div>
                                    <div>
                                        <span class="fa fa-check-circle-o"></span>  @if ($srequipments->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                    </div>

                                </p>
                                <br>
                                <p>
                                    Legends : &nbsp; <span class="fa fa-th"></span> Category &nbsp;| &nbsp;<span class="fa fa-university"></span> Store &nbsp;| &nbsp;<span class="fa fa-map-marker"></span> Location &nbsp;| &nbsp;<span class="fa fa-archive"></span> Archive/Scrap &nbsp;| &nbsp;<span class="fa fa-exchange"></span> Tranfer &nbsp;| &nbsp;<span class="fa fa-wrench"></span> Maintenance &nbsp;| &nbsp;<span class="fa fa-check-circle-o"></span> Approval &nbsp;|
                                </p>
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
