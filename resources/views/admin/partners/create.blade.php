@extends('admin.layout.app')

@section('title')
Add New Partner
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-11">

                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('cnapartners.store') }}" method="post">
                            @csrf

                            <input type="hidden" name="staffcategory_id" value="{{ 3 }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name <strong style="color:red">*</strong></label>
                                        <input id="lastname" type="text"
                                            class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                            name="lastname" value="{{ old('lastname') }}" autofocus
                                            placeholder="Last Name" required>

                                        @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('lastname','Enter Last Name') }}</span>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="">First Name <strong style="color:red">*</strong></label>
                                        <input id="firstname" type="text"
                                            class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                            name="firstname" value="{{ old('firstname') }}" autofocus
                                            placeholder="First Name" required>

                                        @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('firstname','Enter First Name') }}</span>
                                        </span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="">Email <strong style="color:red">*</strong></label>
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" autofocus placeholder="Email"
                                            required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('email','Enter Email Address') }}</span>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone <strong style="color:red">*</strong></label>
                                        <input id="phone" type="tel"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            name="phone" value="{{ old('phone') }}" placeholder="Phone" maxlength="11"
                                            pattern="[0-9]+" required>

                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('phone','Enter Phone number') }}</span>
                                        </span>
                                        @endif
                                    </div>


                                    {{-- <div class="form-group">
                                                <label for="">Staff Category <strong style="color:red;">*</strong></label>
                                                <select name="staffcategory_id" class="form-control">
                                                    <option selected="disabled" value="" required>Select Staff Category</option>
                                                    @foreach ($staffcategories as $staffcategory)
                                                    <option value="{{$staffcategory->id}}">{{$staffcategory->name}}
                                    </option>
                                    @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Partner Location <strong style="color:red;">*</strong></label>
                                    <select name="location_id" class="form-control" required>
                                        <option selected="disabled" value="">Select Partner Location</option>
                                        @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Partner Company <strong style="color:red;">*</strong></label>
                                    <select name="company_id" class="form-control" required>
                                        <option selected="disabled" value="">Select Partner Company</option>
                                        @foreach ($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                    </div>

                    <a href="{{ route('cnapartners.index') }}" class="btn btn-danger btn-sm">Close</a>
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