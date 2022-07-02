@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('transfer.create') }}" class="btn btn-success btn-sm"> <span class="fa fa-exchange"></span> Transfer Equipment</a>

        <br>
        <br>
        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.deleted')
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>SRE</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Transfered By</th>
                                    <th>Qty</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $transfer)
                                <tr>
                                    <td>{{ $transfer->srequipment->name .' with ref #'.$transfer->srequipment->refnumb}}</td>
                                    <td>{{ $transfer->srequipment->store->location->name }}</td>
                                    <td>{{ $transfer->to_location->name }}</td>
                                    <td>{{$transfer->user->firstname.' '.$transfer->user->lastname}}</td>
                                    <td>{{$transfer->qty}}</td>
                                    <td>{{$transfer->reason}}</td>
                                    <td>
                                        @if ($transfer->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Unapproved</span>

                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)
                                                @if ($transfer->isapproved==0)
                                                <form id="approve-{{$transfer->id}}" style="display: none"
                                                    action="{{ route('transfer.approve',$transfer->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$transfer->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @endif

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('transfer.edit',$transfer->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$transfer->id}}" style="display: none"
                                                    action="{{ route('transfer.destroy',$transfer->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$transfer->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SRE</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Transfered By</th>
                                    <th>Qty</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
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
