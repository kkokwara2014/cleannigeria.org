@extends('admin.layout.app')

@section('title')
Biometric Status
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
                    <!-- <a href="{{ route('bio.create') }}" class="btn btn-success btn-sm">
                        <span class="fa fa-eye"></span> Capture Biometric
                    </a> -->
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
                <div class="box">
                

                    <div class="box-body">
                        <table id="example1" class="display table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Bio Status</th>
                                   
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
                                    <td>@if ($staff->bio->count()) <span class="label label-success"> Captured </span> @else <span class="label label-warning">None</span> @endif</td>
                                    <td>
                                        @if(!$staff->bio->count())
                                            <a href="{{ route('bio.add', 'user='.$staff->id) }}" target="_blank" class="btn btn-sm btn-primary">Capture</a>
                                        @else
                                            <form id="remove-{{$staff->id}}" style="display: none"
                                                action="{{ route('bio.destroy',$staff->id) }}" method="post">
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
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Bio Status</th>
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