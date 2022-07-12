@extends('admin.layout.app')

@section('title')
General Timesheet Report
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
                
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Firstname</th>                                   
                                    <th>Lastname</th>                                   
                                    <th>Location</th>                                   
                                    <th>Cloked In</th>                                   
                                    <th>Cloked Out</th>                                                                    
                                    <th>Duration In Mins</th>                                   
                                    <th>Duration In Hours</th>                                   
                                    <th>Actions</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($timesheet as $item)

                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->user->firstname}}</td>
                                    <td>{{$item->user->lastname}}</td>
                                    <td>{{$item->user_location}}</td>
                                    <td>{{$item->clocked_in}}</td>
                                    <td>{{$item->clocked_out}}</td>
                                    <td>{{$item->duration}}</td>
                                    <td>{{ round($item->duration / 60, PHP_ROUND_HALF_UP) }}</td>
                                    <td>
                                        <a href="{{ route('timesheet.monthly.report', [$item->user_id, date('Y-m-d', strtotime($item->clocked_in))]) }}" target="_blank" class="btn btn-sm btn-primary">Montnly</a>
                                        <a href="{{ route('timesheet.yearly.report', [$item->user_id, date('Y-m-d', strtotime($item->clocked_in))]) }}" target="_blank" class="btn btn-sm bg-purple">Yearly</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Firstname</th>                                   
                                    <th>Lastname</th>                                   
                                    <th>Location</th>                                   
                                    <th>Cloked In</th>                                   
                                    <th>Cloked Out</th>                                                                    
                                    <th>Duration In Mins</th>                                   
                                    <th>Duration In Hours</th> 
                                    <th>Actions</th> 

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