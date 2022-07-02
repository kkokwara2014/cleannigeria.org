@extends('admin.layout.app')

@section('title')
    Schedule {{ $maintoption }}
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div class="row">
            <div class="col-md-10">
                <p>
                    <a href="{{ route('maintenanceschedule.index') }}" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> Scheduled Equipment</a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
    
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
    
                            <form action="{{ route('maintenanceschedule.store') }}" method="post">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Schedule Code</label>
                                            <input type="text" class="form-control"
                                                name="schedulecode" value="{{ $generatedcode }}" readonly style="font-size: 25px;">
                                        </div>

                                        <div class="form-group">
                                            <label>Equipment <span style="color: red">*</span></label>
                                            <select name="srequipment_id" class="form-control" required>
                                                <option selected="disabled">Select Equipment</option>
                                                @foreach ($srequipments as $srequipment)
                                                <option value="{{ $srequipment->id }}" {{ old('srequipment_id') == $srequipment->id ? 'selected' : '' }}>{{ $srequipment->name.' ['.$srequipment->refnumb.']' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maintenance Cycle <span style="color: red">*</span></label>
                                            <select id="maintcyclenew" name="maintcycle" class="form-control" required>
                                                <option selected="disabled" value="">Select Maintenance Cycle</option>
                                                <option value="1" {{ old('maintcycle') == '1' ? 'selected' : '' }}>1 month</option>
                                                <option value="3" {{ old('maintcycle') == '3' ? 'selected' : '' }}>3 months</option>
                                                <option value="6" {{ old('maintcycle') == '6' ? 'selected' : '' }}>6 months</option>
                                                <option value="12" {{ old('maintcycle') == '12' ? 'selected' : '' }}>1 Year</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Maintenance Due Date</label>
                                            <input type="text" class="form-control"
                                                name="duedateformaint" id="duedateformaint" readonly style="font-size: 25px;">
                                        </div>

                                        <input type="hidden" id="todayDate" value="{{ date('d-m-Y') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea rows="3" cols="30" name="comment" class="form-control" placeholder="Your comment here..."></textarea>
                                </div>
                                <a href="{{ route('select.maintoption') }}" class="btn btn-danger btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
