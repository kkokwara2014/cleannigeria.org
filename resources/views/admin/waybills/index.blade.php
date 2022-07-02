@extends('admin.layout.app')

@section('title')
    Waybills
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('waybills.create') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-user-plus"></span> Create Waybill
            </a>
            
        </p>

        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle Num</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Creator</th>
                                    <th>Approved?</th>
                                    {{-- <th>Added Years</th> --}}
                                    <th>View Details</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($waybills as $waybill)
                                <tr>
                                    <td>{{ $waybill->waybillnum }}</td>
                                    <td>{{ $waybill->vehiclenum }}</td>
                                    <td>{{ $waybill->waybilllocation->name }}</td>
                                    <td>{{ $waybill->destination }}</td>
                                    <td>{{ $waybill->user->firstname.' '.$waybill->user->lastname }}</td>
                                    <td>
                                       @if ($waybill->isapproved==1)
                                           Yes
                                       @else
                                           No
                                       @endif
                                    </td>
                                    {{-- <td>{{ date('Y',strtotime($waybill->created_at->addYears(2))) }}</td> --}}
                                    <td>
                                        <a href="{{ route('waybills.show',$waybill) }}" class="btn btn-sm btn-warning btn-block">View Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('waybills.edit',$waybill) }}" class="btn btn-sm btn-primary btn-block">Edit</a>
                                    </td>
                                    <td>
                                        <form id="remove-{{$waybill->id}}" style="display: none"
                                            action="{{ route('waybills.destroy',$waybill) }}"
                                            method="post">
                                           @csrf
                                           @method('delete')
                                        </form>
    
                                        <a class="btn btn-danger btn-sm btn-block" href="" onclick="
                                                            if (confirm('Delete this?')) {
                                                                event.preventDefault();
                                                            document.getElementById('remove-{{$waybill->id}}').submit();
                                                            } else {
                                                                event.preventDefault();
                                                            }">Delete
                                            </a>
                                    </td>
                                    <td>
                                        @if($waybill->approver_id==auth()->user()->id && $waybill->isapproved==0)
                                            <form id="approve-{{$waybill->id}}" style="display: none"
                                                action="{{ route('giveapproval',$waybill) }}"
                                                method="post">
                                            @csrf
                                            @method('post')
                                            </form>
        
                                            <a class="btn btn-success btn-sm btn-block" href="" onclick="
                                                                if (confirm('Approve this?')) {
                                                                    event.preventDefault();
                                                                document.getElementById('approve-{{$waybill->id}}').submit();
                                                                } else {
                                                                    event.preventDefault();
                                                                }">Delete
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
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
