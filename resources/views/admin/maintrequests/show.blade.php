@extends('admin.layout.app')

@section('title')
Maintenance Request Detail
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">

                <p>
                    @if ($user->staffcategory_id==3 || $user->staffcategory_id==1 || $user->staffcategory_id==2)
                    <a href="{{ route('maintenancerequest.index') }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-eye"></span> All Maintenance Requests</a>
                    <a href="{{ route('maintenancerequest.create') }}" class="btn btn-success btn-sm"><span
                            class="fa fa-plus"></span> Make Maintenance Request</a>
                    

                   @if ($maintrequest->user_id==auth()->user()->id) 
                    <a href="{{ route('maintenancerequest.edit',$maintrequest->id) }}" class="btn btn-warning btn-sm"><span
                        class="fa fa-pencil"></span> Edit this Request</a>
                   @endif
                    
                            <span style="float: right">
                                <a href="{{ route('printmaintrequest',$maintrequest->id) }}" class="btn btn-success btn-sm btnprintmaintrequest"><span
                                    class="fa fa-print"></span> Print Maintenance Request</a>
                                </span>
                    @endif
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h3>
                            Notifier :
                            <strong>{{ $maintrequest->user->firstname.' '.$maintrequest->user->lastname }}</strong>
                            &nbsp;
                            <small>[{{ $maintrequest->jobdesignation }}]</small>
                        </h3>

                        <div>
                            {{-- @if (auth()->user()->hasAnyRole(['Admin']) || auth()->user()->hasAnyRole(['General
                            Manager'])) --}}
                            @if ($maintrequest->isapproved==1)

                            <span class="badge badge-success badge-pill"
                                style="background-color: green; color:seashell">Approved</span>
                                by <strong>{{ $approver->firstname.' '.$approver->lastname }}</strong>
                            @else
                            <span class="badge badge-danger badge-pill"
                                style="background-color: crimson; color:seashell">Not Approved</span>
                            &nbsp;
                            <a href="" data-toggle="modal" data-target="#modal-default"><span class="fa fa-check-circle"></span> Give Approval</a>
                            @endif
                            {{-- @endif --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Contact Details</strong></h4>
                                <div>
                                    Maintenance Code : #{{ $maintrequest->maintcode }}
                                </div>
                                <div>
                                    Member Company : {{ $maintrequest->membercompany }}
                                </div>
                                <div>
                                    Direct phone : <a
                                        href="tel:{{ $maintrequest->directphone }}">{{ $maintrequest->directphone }}</a>
                                </div>
                                <div>
                                    Email Address : <a
                                        href="mailto:{{ $maintrequest->email }}">{{ $maintrequest->email }}</a>
                                </div>
                                <hr>
                                <h4><strong>Equipment Details</strong></h4>
                                <div>
                                    Date of Request : {{ $maintrequest->dateofrequest }}
                                </div>
                                <div>
                                    Equipment type : {{ $maintrequest->equipmenttype }}
                                </div>
                                <div>
                                    Equipment location : {{ $maintrequest->equipmentlocation }}
                                </div>
                                <div>
                                    Maintenance type : {{ $maintrequest->mainttype }}
                                </div>
                                <div>
                                    Equipment Fault : {{ $maintrequest->equipmentfault }}
                                </div>
                                <div>
                                    Maintained before? :
                                    @if ($maintrequest->cmdonebefore=='Yes')
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell">{{ $maintrequest->cmdonebefore }}</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: crimson; color:seashell">{{ $maintrequest->cmdonebefore }}</span>


                                    @endif

                                </div>
                                <div>
                                    Spare part available? :
                                    @if ($maintrequest->sparepartavailable=='Yes')
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell">{{ $maintrequest->sparepartavailable }}</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: crimson; color:seashell">{{ $maintrequest->sparepartavailable }}</span>
                                    @endif
                                </div>
                                <div>
                                    Is SRE maintenance taking place in your location? :
                                    @if ($maintrequest->sremaintinplace=='Yes')
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell">{{ $maintrequest->sremaintinplace }}</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: crimson; color:seashell">{{ $maintrequest->sremaintinplace }}</span>
                                    @endif
                                </div>
                                <div>
                                    Expected Maintenance date :
                                    {{ date('d M, Y',strtotime($maintrequest->expectedmaintdate)) }}
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Health, Safety & Environment</strong></h4>
                                <div style="text-align: justify">
                                    HSE Risk Description :
                                    {{ $maintrequest->hseriskdesc }}
                                </div>
                                <div style="text-align: justify">
                                    Security Risk Description :
                                    {{ $maintrequest->secriskdesc }}
                                </div>
                                <div style="text-align: justify">
                                    Security Arrangement Description :
                                    {{ $maintrequest->secarrangementdesc }}
                                </div>
                                <hr>
                                <h4><strong>Additional Information</strong></h4>
                                <div style="text-align: justify">
                                    {{ $maintrequest->moreinfo }}
                                </div>
                                <div>
                                    @if ($maintrequest->covidppe!=NULL)
                                    {{ $maintrequest->covidppe }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->accomodation!=NULL)
                                    {{ $maintrequest->accomodation }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->safetyoflocation!=NULL)
                                    {{ $maintrequest->safetyoflocation }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->armedsecurity!=NULL)
                                    {{ $maintrequest->armedsecurity }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->transportation!=NULL)
                                    {{ $maintrequest->transportation }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->communiservice!=NULL)
                                    {{ $maintrequest->communiservice }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->incidentsiteaccess!=NULL)
                                    {{ $maintrequest->incidentsiteaccess }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->medicalservices!=NULL)
                                    {{ $maintrequest->medicalservices }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->welfare!=NULL)
                                    {{ $maintrequest->welfare }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                                <div>
                                    @if ($maintrequest->safetycriticaldevice!=NULL)
                                    {{ $maintrequest->safetycriticaldevice }} &nbsp;
                                    <span class="fa fa-check"></span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- maintenance request approval modal area --}}
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">

                    <form action="{{ route('approvemaintrequest',$maintrequest->id) }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><span class="fa fa-check-circle"></span> Maintenance Request Approval</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="">Approval Comment <strong style="color:red;">*</strong></label>
                                    <textarea name="approvercomment" id="" cols="30" rows="3" class="form-control" placeholder="Comment here..." required></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->

                    </form>
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

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