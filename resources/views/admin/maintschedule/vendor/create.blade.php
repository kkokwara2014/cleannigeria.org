@extends('admin.layout.app')

@section('title')
   Create Vendor
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
    
                            <form action="{{ route('vendors.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Vendor Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control"
                                        name="vendorname" value="{{ old('vendorname') }}" placeholder="Vendor Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span style="color: red">*</span></label>
                                    <input type="text" class="form-control"
                                        name="vendorphone" value="{{ old('vendorphone') }}" placeholder="Vendor Phone" required pattern="[0-9]+" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label>Address <span style="color: red">*</span></label>
                                    <textarea rows="3" cols="30" name="vendoraddress" class="form-control" placeholder="Vendor Address here..." required></textarea>
                                </div>
                                
                                <button type="reset" class="btn btn-danger btn-sm">Cancel</button>
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
