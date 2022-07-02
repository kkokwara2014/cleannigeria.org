@extends('admin.layout.app')

@section('title')
    Create Trainee
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('trainees.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Trainees
            </a>
        </p>

        <div class="row">
            <div class="col-md-11">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('trainees.store') }}" method="post">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                            name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" autofocus required>
        
                                        @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('lastname') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>First Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                            name="firstname" value="{{ old('firstname') }}" placeholder="first Name" required>
        
                                        @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('firstname') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Other Name</label>
                                        <input type="text" class="form-control{{ $errors->has('othername') ? ' is-invalid' : '' }}"
                                            name="othername" value="{{ old('othername') }}" placeholder="Other Name" autofocus>
        
                                        @if ($errors->has('othername'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('othername') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control{{ $errors->has('traineeemail') ? ' is-invalid' : '' }}"
                                            name="traineeemail" value="{{ old('traineeemail') }}" placeholder="Email Address" required>
        
                                        @if ($errors->has('traineeemail'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('traineeemail') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span style="color: red">*</span></label>
                                        <input type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required pattern="[0-9]+" maxlength="11">
        
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('phone') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Company Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('companyname') ? ' is-invalid' : '' }}"
                                            name="companyname" value="{{ old('companyname') }}" placeholder="Company Name" required>
        
                                        @if ($errors->has('companyname'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('companyname') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <a href="{{ route('trainees.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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
