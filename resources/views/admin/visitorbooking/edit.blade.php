@extends('admin.layout.app')

@section('title')
    Edit Visitor Booking
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('supplier.index') }}" class="btn btn-success btn-sm">
            <span class="fa fa-eye"></span> All Suppliers
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-5">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('supplier.update',$suppliers->id) }}" method="post">
                          @csrf
                          @method('put')

                            <div class="form-group">
                                <label for="">Company Name *</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ $suppliers->name }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('name','Enter Company Name') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ $suppliers->email }}" autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('email','Enter Email Address') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Phone *</label>
                                <input type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    name="phone" value="{{ $suppliers->phone }}" autofocus pattern="[0-9]+"
                                    maxlength="11">

                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('phone','Enter Phone Number') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" id="" cols="30" rows="3"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
                                {{ $suppliers->address }}
                                </textarea>

                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('address','Enter Company Address') }}</span>
                                </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('supplier.index') }}" class="btn btn-default btn-sm">Cancel</a>

                    </div>
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
