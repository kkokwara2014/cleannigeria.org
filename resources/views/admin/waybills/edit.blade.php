@extends('admin.layout.app')

@section('title')
    Edit Waybill
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('waybills.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Waybills
            </a>
            <a href="{{ route('waybills.create') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-user-plus"></span> Create Waybill
            </a>
        </p>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                       
                        <form action="{{ route('waybills.update',$waybill->id) }}" method="post">
                            @csrf
                           @method('put')
                           <input type="hidden" name="waybillnum" value="{{ $waybill->waybillnum }}">
                           
                            <div class="form-group">
                                <label for="">Vehicle Number</label>
                                <input type="text" name="vehiclenum" class="form-control" placeholder="Vehicle Number"
                                    required value="{{ $waybill->vehiclenum }}">
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">From</label>
                                        <select name="waybilllocation_id" class="form-control" required>
                                            <option value="" selected="disabled">Select Location</option>
                                            @foreach ($waybilllocations as $waybillloc)
                                            <option value="{{ $waybillloc->id }}" {{ $waybill->waybilllocation_id==$waybillloc->id?'selected':'' }}>{{ $waybillloc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Destination</label>
                                        <input type="text" name="destination" class="form-control" placeholder="Destination"
                                            required value="{{ $waybill->destination }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Receiver</label>
                                        <select name="receiver_id" class="form-control" required>
                                            <option value="" selected="disabled">Select Receiver</option>
                                            @foreach ($approvers as $approver)
                                            <option value="{{ $approver->id }}" {{ $waybill->approver_id==$approver->id?'selected':'' }}>{{ $approver->firstname.' '.$approver->lastname.' ['.$approver->email.']' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Approver</label>
                                        <select name="approver_id" class="form-control" required>
                                            <option value="" selected="disabled">Select Receiver</option>
                                            @foreach ($approvers as $receiver)
                                            <option value="{{ $receiver->id }}" {{ $waybill->receiver_id==$receiver->id?'selected':'' }}>{{ $receiver->firstname.' '.$receiver->lastname.' ['.$receiver->email.']' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
    
                            </div>
    
                            <div class="form-group">
                                <label for="">Creator</label>
                                <input type="text" name="creator" class="form-control" readonly
                                    value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">
                            </div>
                            <hr>
                            <h4>Input Waybill Items</h4>
                            <table class="table table-light table-striped" id="waybill_table">
                                <tbody>
                                    <tr>
                                        <td>Store Issue Voucher</td>
                                        <td>Description</td>
                                        <td><button type="button" name="add" id="addwaybill"
                                                class="btn btn-success btn-sm">+</button></td>
                                    </tr>
                                   @foreach ($waybill->waybillitems as $key=>$waybillitem)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="issuenum[]"
                                                placeholder="Voucher Number" value="{{ $waybillitem->issuenum }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="description[]"
                                                placeholder="Description" required value="{{ $waybillitem->description }}">
                                        </td>
                                        <td><button type="button" name="remove" class="btn btn-danger btn-sm removewaybill"
                                                data-row="row1">x</button></td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success btn-sm">Update Waybill</button>
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
