@extends('admin.layout.app')

@section('title')
Manage Users
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
                @include('admin.messages.success')
                @include('admin.messages.deleted')
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)

                                <tr>
                                    <td>{{$staff->lastname}}</td>
                                    <td>{{$staff->firstname}}</td>
                                    <td>{{$staff->email}}</td>
                                    <td>{{$staff->phone}}</td>
                                    <td>{{ implode(', ',$staff->roles()->get()->pluck('name')->toArray()) }}</td>
                                    

                                    <td>
                                        <a href="{{ route('manageusers.edit',$staff->id) }}">
                                            <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-pencil"></span> Edit</button>
                                        </a>

                                        <form id="remove-{{$staff->id}}" style="display: none"
                                            action="{{ route('manageusers.destroy',$staff->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a href="" onclick="
                                                                if (confirm('Delete this?')) {
                                                                    event.preventDefault();
                                                                document.getElementById('remove-{{$staff->id}}').submit();
                                                                } else {
                                                                    event.preventDefault();
                                                                }
                                                            ">
                                                            <button type="button" class="btn btn-sm btn-danger"><span class="fa fa-trash-o"></span>
                                                                Delete</button>
                                                            
                                        </a>
                                         <a href="{{ route('staff.impersonate',$staff->id) }}">
                                            <button type="button" class="btn btn-sm btn-warning"><span class="fa fa-exchange"></span> Impersonate</button>
                                        </a> 

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Staff Num.</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
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