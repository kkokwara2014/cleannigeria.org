@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <a class="btn btn-success btn-sm" href="{{ route('schedules.index') }}"><span class="fa fa-eye"></span> All Schdeules</a>
        <br><br>

        <div class="row">
            <div class="col-md-8">


                @include('admin.messages.success')
                @include('admin.messages.deleted')
                @include('admin.messages.refusal')


                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('schedules.update',$schedule) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label for="">Machine <strong style="color: red">*</strong></label>
                                        <select name="machine_id" class="form-control" required>
                                            <option selected="disabled" value="">Select Machine</option>
                                            @foreach ($machines as $machine)
                                            <option value="{{$machine->id}}" {{ $machine->id== $schedule->machine_id?'selected':'' }}>
                                                {{'#'.$machine->uniquenumb.' - ' .$machine->name.' in '.$machine->location->name}}
                                            </option>
                                            
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Schedule Type <strong style="color: red">*</strong></label>
                                        
                                        <select name="schedtype_id" class="form-control" required>
                                            <option selected="disabled" value="">Select Schedule Type</option>
                                            @foreach ($scheduletypes as $schedtype)
                                            <option value="{{$schedtype->id}}" {{ $schedtype->id== $schedule->schedtype_id?'selected':'' }}>
                                                {{$schedtype->name}}
                                            </option>
                
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <div id="maintcycle">
                                        <h4>Maintenance Schedule</h4>
                                        
                                        <input type="hidden" name="nextmaintperiod">
                                       
                                    </div>
                                                                        
                                </div>
                            </div>
                                
                            <br>
                            <a href="{{ route('schedules.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            
                        </form>
                                                
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
