@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a class="btn btn-primary btn-sm" href="{{ route('schedules.create') }}"><span class="fa fa-plus"></span> Make Schedule</a>
            <a class="btn btn-warning btn-sm" href="{{ route('machines.index') }}"><span class="fa fa-eye"></span> All Machines</a>
            <a class="btn btn-success btn-sm" href="{{ route('machinemaints.index') }}"><span class="fa fa-eye"></span> All Machine Maintenances</a>
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
                                    <th>Machine Name</th>
                                    <th>Schedule Type</th>
                                    <th>Maint. Due Time</th>
                                    <th>Scheduled By</th>
                                    <th>Approved?</th>
                                    <th>View</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                @if($user->id==$schedule->user_id ||Auth::user()->role->id==1||Auth::user()->role->id==2)
                                <tr>
                                    <td><a href="{{ route('schedules.show',$schedule->id) }}">{{$schedule->uniquenumb}}</a></td>
                                    <td>{{$schedule->machine->name }}</td>
                                    <td>{{$schedule->schedtype->name }}</td>
                                    <td>
                                        {{ $schedule->nextmaintperiod .' '.($schedule->nextmaintperiod>1?' months':' month')}}
                                    </td>
                                    <td>{{$schedule->user->firstname.' '.$schedule->user->lastname}}</td>
                                    <td>
                                        @if ($schedule->isapproved==1)
                                            <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                            <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>
                                        @endif
                                    </td>                                     
                                    
                                    <td><a href="{{ route('schedules.show',$schedule->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2 || $schedule->isapproved==0)
                                                <form id="approve-{{$schedule->id}}" style="display: none"
                                                    action="{{ route('schedule.confirm',$schedule->id) }}" method="post">
                                                    @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$schedule->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @if ($schedule->isapproved==0)
                                                                                                                                       

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('schedules.edit',$schedule->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$schedule->id}}" style="display: none"
                                                    action="{{ route('schedules.destroy',$schedule->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$schedule->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>

                                                @endif

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Machine Name</th>
                                    <th>Schedule Type</th>
                                    <th>Maint. Due Time</th>
                                    <th>Scheduled By</th>
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