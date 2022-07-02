@extends('admin.layout.app')

@section('title')
Work Order Details
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
                    <a href="{{ route('workorder.index') }}" class="btn btn-success btn-sm"><span
                            class="fa fa-eye"></span> All Work Orders</a>

                    <span style="float: right">
                        <a target="_blank"
                        href="{{ route('print.workorder',$workorder->id) }}"
                        class="btn btn-primary btn-sm btnprntworkorder" style="float: right"><span class="fa fa-print"></span>
                        Print Work Order</a>
                    </span>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Equipment/Work Order Information
                                    </div>
                                    <div class="panel-body">
                                        <div>Work Order Number: <strong>#{{ $workorder->uniquecode }}</strong></div>
                                        <div>Equipment : {{ $workorder->srequipment->name }}</div>
                                        <div>Equipment Location : {{ $workorder->srequipment->store->location->name }}
                                        </div>
                                        <div>Maintenance Due Date : {{ $workorder->duedateformaint }}</div>
                                        <div>Work Order Amount : <strong>=N={{ number_format($workorder->amount,2) }}</strong></div>
                                        <div>Description : {{ $workorder->description }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Vendor Information
                                    </div>
                                    <div class="panel-body">
                                        <div>
                                            Name : {{ $workorder->vendor->vendorname }}
                                        </div>
                                        <div>
                                            Vendor Phone : {{ $workorder->vendor->vendorphone }}
                                        </div>
                                        <div>
                                            Vendor Address : {{ $workorder->vendor->vendoraddress }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    Created By:
                                    <strong>{{ $workorder->user->firstname.' '.$workorder->user->lastname .' - '.$workorder->user->phone}}</strong>
                                </div>
                                <div>
                                    <span class="fa fa-briefcase"></span> {{ $workorder->user->role->name }}
                                </div>
                                <div>
                                    Created : {{ $workorder->created_at }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    Approver : <strong>{{ $approver->firstname.' '.$approver->lastname }}</strong>
                                </div>
                                <div>
                                    <span class="fa fa-phone"></span> {{ $approver->phone }}
                                </div>
                                <div>
                                    @if ($workorder->isapproved1==0 && $workorder->sentto_id==auth()->user()->id)
                                    <a href="" data-toggle="modal"
                                        data-target="#modal-firstapproval-{{ $workorder->id }}"
                                        class="btn btn-primary btn-sm">Give Approval</a>

                                    <!-- Modal for giving first approval -->
                                    <div class="modal fade" id="modal-firstapproval-{{ $workorder->id }}">
                                        <div class="modal-dialog">

                                            <form action="{{ route('givefirstapproval',$workorder->id) }}"
                                                onsubmit="return confirm ('Do you want to give Approval?')"
                                                method="post">
                                                @csrf
                                             
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"> Give Approval</h4>
                                                    </div>
                                                    <div class="modal-body">


                                                            <div class="form-group">
                                                                <textarea class="form-control"
                                                                    name="firstapprovercomment" id="" cols="30" rows="3"
                                                                    placeholder="Your comment here..."
                                                                    required></textarea>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Approve</button>
                                                            </div>
                                                       
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->

                                            </form>
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    @elseif($workorder->isapproved1==1)
                                        <hr>
                                        
                                        <span class="badge badge-pill badge-primary"
                                        style="background-color: green; color:whitesmoke"><span
                                            class="fa fa-check-o"></span> 
                                            Approved!
                                        </span>
                                        
                                            <div>
                                                Comment : {{ $workorder->firstapprovercomment }}
                                            </div>
                                            <div>
                                                Date : {{ $workorder->firstapproveddate }}
                                            </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    Final Approver : <strong>{{ $finalapprover->firstname.' '.$finalapprover->lastname }}</strong>
                                </div>
                                <div>
                                    <span class="fa fa-phone"></span> {{ $finalapprover->phone }}
                                </div>
                                <div>
                                    @if ($workorder->isapproved1==1 && $workorder->isapproved2==0 && (auth()->user()->role_id==1 || auth()->user()->role_id==2))
                                    <a href="" data-toggle="modal"
                                        data-target="#modal-finalapproval-{{ $workorder->id }}"
                                        class="btn btn-primary btn-sm">Give Final Approval</a>

                                    <!-- Modal for giving final approval -->
                                    <div class="modal fade" id="modal-finalapproval-{{ $workorder->id }}">
                                        <div class="modal-dialog">

                                            <form action="{{ route('givefinalapproval',$workorder->id) }}"
                                                onsubmit="return confirm ('Do you want to give final Approval?')"
                                                method="post">
                                                @csrf
                                             
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"> Give Final Approval</h4>
                                                    </div>
                                                    <div class="modal-body">


                                                            <div class="form-group">
                                                                <textarea class="form-control"
                                                                    name="secondapprovercomment" id="" cols="30" rows="3"
                                                                    placeholder="Your comment here..."
                                                                    required></textarea>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Approve</button>
                                                            </div>
                                                       
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->

                                            </form>
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    @elseif($workorder->isapproved2==1)
                                        <hr>
                                        
                                        <span class="badge badge-pill badge-primary"
                                        style="background-color: green; color:whitesmoke"><span
                                            class="fa fa-check-o"></span> 
                                            Approved!
                                        </span>
                                        
                                            <div>
                                                Comment : {{ $workorder->secondapprovercomment }}
                                            </div>
                                            <div>
                                                Date : {{ $workorder->secondapproveddate }}
                                            </div>
                                    @endif
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