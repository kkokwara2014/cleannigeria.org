@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        @if (Auth::user()->updateempinfo==0)
        <p>
        <a href="{{route('employees.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Add Employee Information</a>
        </p>
        @endif

        <div class="row">
            <div class="col-md-12">

                {{-- for messages --}}
                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>Image</th> --}}
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>View Details</th>
                                    
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)

                                @if ($employee->user_id==Auth::user()->id || Auth::user()->hasAnyRole(['Admin'])||
                                Auth::user()->hasAnyRole(['General Manager']))
                                <tr>

                                    {{-- <td>
                                        <img src="{{url('user_images',$employee->user->userimage)}}" alt=""
                                            class="img-responsive img-rounded" width="40" height="40" style="border-radius: 50%">
                                    </td> --}}
                                    <td>{{$employee->user->lastname}}</td>
                                    <td>{{$employee->user->firstname}}</td>
                                    <td>{{$employee->user->email}}</td>
                                    <td>{{$employee->user->phone}}</td>
                                    <td><a href="{{ route('employees.show',$employee->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>
                                    
                                   
                                    <td>


                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                id="dropdownMenu1" data-toggle="dropdown"> Action &nbsp;&nbsp;<span
                                                    class="caret"></span> </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                
                                                @if ($employee->user_id==Auth::user()->id || Auth::user()->hasAnyRole(['Admin']))
                                                    
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('employees.edit',$employee->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$employee->id}}" style="display: none"
                                                    action="{{ route('employees.destroy',$employee->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                            if (confirm('Are you sure you want to delete this?')) {
                                                                                event.preventDefault();
                                                                            document.getElementById('remove-{{$employee->id}}').submit();
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
                            {{-- <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>View Details</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
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
