@extends('admin.layout.app')

@section('title')
{{$timesheet[0]->user->firstname."'s"}} 
@if ($for_period == 'monthly')
   {{ date('M, Y', strtotime($timesheet[0]->created_at)) }}
@else
    {{ date('Y', strtotime($timesheet[0]->created_at)) }}
@endif

Timesheet Report

@php
    $printType = ($for_period == 'monthly') ? 'monthly' : 'yearly';
@endphp

<a style="float: right" href="{{ route('print.bio',[$timesheet[0]->user_id, date('Y-m-d', strtotime($timesheet[0]->created_at)), $printType]) }}" class="btn btn-success btn-sm btnprintway">
    <span class="fa fa-print"></span> Print Report
</a>
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
                                <tr class="bg-navy">
                                    <th colspan="@if ($for_period !='yearly') 7 @else 6 @endif">&nbsp</th>
                                    <th>Total Man Hour</th>
                                    <th>{{$manhour}} hr(s)</th>                                                                     
                                </tr>
                                <tr>
                                    <th>S/N</th>
                                    <th>Firstname</th>                                   
                                    <th>Lastname</th>                                   
                                    <th>Location</th>                                   
                                    <th>Cloked In</th>                                   
                                    <th>Cloked Out</th>                                                                    
                                    <th>Duration In Mins</th>                                   
                                    <th>Duration In Hours</th> 
                                    
                                    @if ($for_period !='yearly')                                  
                                        <th>Actions</th>          
                                    @endif                         
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
                                    <td>{{$item->duration}} min(s)</td>
                                    <td>{{ round($item->duration / 60, PHP_ROUND_HALF_UP) }} hr(s)</td>
                                    
                                    @if ($for_period !='yearly')
                                        <td>
                                            <a href="{{ route('timesheet.yearly.report', [$item->user_id, date('Y-m-d', strtotime($item->clocked_in))]) }}" target="_blank" class="btn btn-sm bg-purple">Yearly</a>
                                        </td>
                                    @endif

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
                                    
                                    @if ($for_period !='yearly')  
                                        <th>Actions</th> 
                                    @endif
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