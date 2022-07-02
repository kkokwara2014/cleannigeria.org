@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <a class="btn btn-success btn-sm" href="{{ route('machinemaints.index') }}"><span class="fa fa-eye"></span> All Machine Maintenances</a>
        <br><br>

        <div class="row">
            <div class="col-md-11">


                @include('admin.messages.success')
                @include('admin.messages.deleted')
                @include('admin.messages.refusal')


                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('machinemaints.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label for="">Approved Scheduled Machines <strong style="color: red">*</strong></label>
                                        <select name="schedule_id" class="form-control" required>
                                            <option selected="disabled">Select Scheduled Machines</option>
                                            @foreach ($schedules as $schedule)
                                            <option value="{{$schedule->id}}">
                                                {{'#'.$schedule->machine->uniquenumb.' - '.$schedule->machine->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="">Maintenance Start Date <strong style="color: red">*</strong></label>
                                        <input type="text" id="datepicker" name="startdate" class="form-control" placeholder="Start Date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Maintenance End Date <strong style="color: red">*</strong></label>
                                        <input type="text" id="datepicker1" name="enddate" class="form-control" placeholder="End Date" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Action Taken <strong style="color: red">*</strong></label>
                                        <textarea name="actiontaken" class="form-control" cols="30" rows="2"
                                            value="{{ old('actiontaken') }}" placeholder="Action Taken"
                                            required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Recommendation <strong style="color: red">*</strong></label>
                                        <textarea name="recommendation" class="form-control" cols="30" rows="2"
                                            value="{{ old('recommendation') }}" placeholder="Recommendation"
                                            required></textarea>
                                    </div>
                                </div>
                                

                            </div>
                                                        
                            <a href="{{ route('machinemaints.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            
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
