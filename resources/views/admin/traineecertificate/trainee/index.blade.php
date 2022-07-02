@extends('admin.layout.app')

@section('title')
    Trainees
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('trainees.create') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-user-plus"></span> Add Trainee
            </a>
            <a href="{{ route('trainings.index') }}" class="btn btn-warning btn-sm">
                <span class="fa fa-users"></span> All Trainings
            </a>
            <a href="{{ route('certificates.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-certificate"></span> All Certificates
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Creator</th>
                                   
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alltrainees as $trainee)
                                <tr>
                                    <td>{{ $trainee->firstname.' '.strtoupper($trainee->lastname) }}</td>
                                    <td>{{ $trainee->traineeemail }}</td>
                                    <td>{{ $trainee->phone }}</td>
                                    <td>{{ $trainee->companyname }}</td>
                                    <td>{{ $trainee->user->firstname.' '.$trainee->user->lastname }}</td>
                                    
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle btn-block" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('trainees.edit',$trainee->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$trainee->id}}" style="display: none"
                                                    action="{{ route('trainees.destroy',$trainee->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$trainee->id}}').submit();
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Creator</th>
                                   
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
