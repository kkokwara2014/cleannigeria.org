@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        <a href="{{ route('maintenance.create') }}" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> Log Maintenance Details</a>
        <br><br>

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
                                    <th>Equiment</th>
                                    <th>Serviced By</th>
                                    <th>Last Maint. Date</th>
                                    <th>Next Maint. Date</th>
                                    <th>Confirmed?</th>
                                    <th>Approved?</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                <tr>
                                    <td>{{$maintenance->srequipment->name}}</td>
                                    <td>{{$maintenance->user->firstname.' '.$maintenance->user->lastname}}</td>

                                    <td>{{$maintenance->lastmaintdate}}</td>
                                    <td>{{$maintenance->nextmaintdate}}</td>
                                    <td>
                                        @if ($maintenance->isconfirmed==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Confirmed</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Confirmed</span>

                                        @endif
                                    </td>
                                    <td>
                                        @if ($maintenance->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                    </td>
                                    <td><a href="{{ route('maintenance.show',$maintenance->id) }}"><span
                                        class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)

                                                @if ($maintenance->isapproved==0)
                                                <form id="approve-{{$maintenance->id}}" style="display: none"
                                                    action="{{ route('maintenance.approve',$maintenance->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$maintenance->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>

                                                @endif
                                                @if ($maintenance->isconfirmed==0)
                                                <form id="confirm-{{$maintenance->id}}" style="display: none"
                                                    action="{{ route('maintenance.confirm',$maintenance->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Confirm this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('confirm-{{$maintenance->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check"></span>
                                                        Confirm
                                                    </a>
                                                </li>

                                                @endif
                                                @endif


                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('maintenance.edit',$maintenance->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$maintenance->id}}" style="display: none"
                                                    action="{{ route('maintenance.destroy',$maintenance->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$maintenance->id}}').submit();
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
                                    <th>Equiment</th>
                                    <th>Serviced By</th>
                                    <th>Last Maint. Date</th>
                                    <th>Next Maint. Date</th>
                                    <th>Confirmed?</th>
                                    <th>Approved?</th>
                                    <th>View</th>
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
