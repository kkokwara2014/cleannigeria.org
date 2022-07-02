@extends('admin.layout.app')

@section('title')
   Edit Vendor
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div class="row">
            <div class="col-md-7">
                <p>
                    <a href="{{ route('vendors.index') }}" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> All Vendors</a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
    
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
    
                            <form action="{{ route('vendors.update',$vendor->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Vendor Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control"
                                        name="vendorname" value="{{ $vendor->vendorname }}" placeholder="Vendor Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span style="color: red">*</span></label>
                                    <input type="text" class="form-control"
                                        name="vendorphone" value="{{ $vendor->vendorphone }}" placeholder="Vendor Phone" required pattern="[0-9]+" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label>Address <span style="color: red">*</span></label>
                                    <textarea rows="3" cols="30" name="vendoraddress" class="form-control" placeholder="Vendor Address here..." required>{{ $vendor->vendoraddress }}</textarea>
                                </div>
                                
                                <a href="{{ route('vendors.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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
