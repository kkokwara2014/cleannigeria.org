@extends('admin.layout.app')

@section('title')
Create {{ $maintoption }} Work Order
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

                        <form action="{{ route('workorder.store') }}" method="post">
                            @csrf


                            <div class="form-group">
                                <label>Work Order Code</label>
                                <input type="text" class="form-control" name="uniquecode"
                                    value="{{ $generatedcode }}" readonly style="font-size: 25px;">
                            </div>

                            <div class="form-group">
                                <label>Equipment <span style="color: red">*</span></label>
                                <select name="srequipment_id" class="form-control" required>
                                    <option selected="disabled">Select Equipment</option>
                                    @foreach ($srequipments as $srequipment)
                                    <option value="{{ $srequipment->id }}" {{ old('srequipment_id')==$srequipment->id ?
                                        'selected' : '' }}>{{ $srequipment->name.' ['.$srequipment->refnumb.']' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vendor <span style="color: red">*</span></label>
                                <select name="vendor_id" class="form-control" required>
                                    <option selected="disabled">Select Vendor</option>
                                    @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">
                                        {{ $vendor->vendorname.' ['.$vendor->vendorphone.']' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="amount" placeholder="Amount e.g 15000" pattern="[0-9]+" maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maintenance Due Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" name="duedateformaint">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Work Description <span style="color: red">*</span></label>
                                <textarea rows="5" cols="30" name="description" class="form-control"
                                    placeholder="Your description here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Approver <span style="color: red">*</span></label>
                                <select name="sentto_id" class="form-control" required>
                                    <option selected="disabled">Select Approver</option>
                                    @foreach ($senttos as $sentto)
                                    <option value="{{ $sentto->id }}">
                                        {{ $sentto->firstname.' '.$sentto->lastname.' ['.$sentto->email.']' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="maintoption" value="{{ $maintoption }} ">

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