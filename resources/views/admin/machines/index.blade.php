@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a class="btn btn-warning btn-sm" href="{{ route('machines.create') }}"><span class="fa fa-plus"></span> Add Machine</a>
            <a class="btn btn-primary btn-sm" href="{{ route('schedules.index') }}"><span class="fa fa-eye"></span> All Schedules</a>
            <a class="btn btn-success btn-sm" href="{{ route('machinemaints.index') }}"><span class="fa fa-eye"></span> All Machine Maintenance</a>
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
                                    <th>Name</th>4
                                    <th>Status</th>
                                    <th>Before Usage</th>
                                    <th>After Usage</th>
                                    <th>Added By</th>
                                    <th>View</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machines as $machine)
                                @if($user->id==$machine->user_id ||Auth::user()->role->id==1||Auth::user()->role->id==2)
                                <tr>
                                    <td><a href="{{ route('machines.show',$machine->id) }}">{{$machine->uniquenumb}}</a></td>
                                    <td>{{$machine->name }}</td>
                                    <td>{{$machine->status }}</td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $machine->beforeuse }}"> Before Usage Tip </a>
                                        
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $machine->afteruse }}"> After Usage Tip </a>
                                       
                                    </td>
                                    <td>{{$machine->user->firstname.' '.$machine->user->lastname}}</td>
                                                                      
                                    
                                    <td><a href="{{ route('machines.show',$machine->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                                                             

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('machines.edit',$machine->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$machine->id}}" style="display: none"
                                                    action="{{ route('machines.destroy',$machine->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$machine->id}}').submit();
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
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Before Usage</th>
                                    <th>After Usage</th>
                                    <th>Added By</th>
                                    
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