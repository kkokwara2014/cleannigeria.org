@extends('admin.layout.app')

@section('title')
    Trainings
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('trainings.create') }}" class="btn btn-warning btn-sm">
                <span class="fa fa-calendar-check-o"></span> Add Training
            </a>
            <a href="{{ route('trainees.index') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-users"></span> All Trainees
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
                                    <th>Name</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Creator</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainings as $training)
                                <tr>
                                    <td>{{ $training->name }}</td>
                                    <td>{{ date('d M, Y',strtotime($training->startdate)) }}</td>
                                    <td>{{ date('d M, Y',strtotime($training->enddate)) }}</td>
                                    <td>{{ $training->user->firstname.' '.$training->user->lastname }}</td>
                                    
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-block btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('trainings.edit',$training->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$training->id}}" style="display: none"
                                                    action="{{ route('trainings.destroy',$training->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$training->id}}').submit();
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
                                    <th>Name</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
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
