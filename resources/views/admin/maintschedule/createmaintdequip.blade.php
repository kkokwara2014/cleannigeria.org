@extends('admin.layout.app')

@section('title')
Add Maintained Equipment Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div class="row">
            <div class="col-md-9">
                <p>
                    <a href="{{ route('maintenanceschedule.index') }}" class="btn btn-success btn-sm"><span
                            class="fa fa-eye"></span> Scheduled Equipment</a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('maintainedequipment.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="maintschedule_id" value="{{ $maintschedule->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div><label>Maintenance Type <span style="color: red">*</span></label></div>
                                        <input type="radio" name="maintenancetype" value="Corrective Maintenance"> Corrective Maintenance
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <input type="radio" name="maintenancetype" value="Preventive Maintenance"> Preventive Maintenance
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Equipment Name </label>
                                <input type="text" class="form-control" value="{{ $maintschedule->srequipment->name.' ['.$maintschedule->srequipment->refnumb.']' }}" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maintenance Start Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" name="maintstartdate" required value="{{ old('maintstartdate') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maintenance End Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" name="maintenddate" required value="{{ old('maintstartdate') }}">
                                    </div>
                                </div>
                            </div>
                                                       
                            <div class="form-group">
                                <label>Activity(s) Performed <span style="color: red">*</span></label>
                                <textarea name="activitydone" class="form-control" cols="30" rows="3"
                                    placeholder="Write what you did here..." required>{{ old('activitydone') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload File <span style="color: red">*</span></label>
                                <input type="file" name="maintreportfile" required>
                            </div>
                            <div class="form-group">
                                <label>Select Approver <span style="color: red">*</span></label>
                                <select name="sentto_id" class="form-control" required>
                                    <option selected="disabled">Select Recipient</option>
                                    @foreach ($receivingstaffs as $recipient)
                                    <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>{{ $recipient->firstname.' '.$recipient->lastname.' ['.$recipient->email.']' }}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <a href="{{ route('maintenanceschedule.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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