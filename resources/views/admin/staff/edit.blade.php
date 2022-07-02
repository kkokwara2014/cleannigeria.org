@extends('admin.layout.app')

@section('title')
Edit Staff Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('staff.index') }}" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> All Staff</a>
        <br><br>


        <div class="row">
            <div class="col-md-10">

                {{-- for messages --}}
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('staff.update',$staff->id) }}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name <strong style="color:red">*</strong></label>
                                        <input id="lastname" type="text"
                                            class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                            name="lastname" required autofocus
                                            value="{{ $staff->lastname }}">

                                        @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="">First Name <strong style="color:red">*</strong></label>
                                        <input id="firstname" type="text"
                                            class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                            name="firstname" required autofocus
                                            value="{{ $staff->firstname }}">

                                        @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="">Email <strong style="color:red">*</strong></label>
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" required autofocus
                                            value="{{ $staff->email }}">

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone <strong style="color:red">*</strong></label>
                                        <input id="phone" type="tel"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            name="phone" value="{{ $staff->phone }}" required
                                            maxlength="11" pattern="[0-9]+">

                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password <strong style="color:red">*</strong></label>
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">



                                    <div class="form-group">
                                        <label for="">Repeat Password <strong style="color:red">*</strong></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required placeholder="Repeat Password">
                                    </div>

                                    <div>
                                        <label for="">Staff Category <strong style="color:red;">*</strong></label>
                                        <select name="staffcategory_id" class="form-control">
                                            <option selected="disabled">Select Staff Category</option>
                                            @foreach ($staffcategories as $staffcategory)
                                            <option value="{{$staffcategory->id}}" {{$staffcategory->id==$staff->staffcategory_id ? 'selected':''}}>{{$staffcategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="">Staff Location <strong style="color:red;">*</strong></label>
                                        <select name="location_id" class="form-control">
                                            <option selected="disabled">Select Staff Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->id}}" {{$location->id==$staff->location_id ? 'selected':''}}>{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="">Role <strong style="color:red;">*</strong></label>
                                        <select name="role_id" class="form-control">
                                            <option selected="disabled">Select Staff Role</option>
                                            @foreach ($staffroles as $staffrole)
                                            <option value="{{$staffrole->id}}" {{$staffrole->id==$staff->role_id ? 'selected':''}}>{{$staffrole->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                                <div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    <a href="{{ route('staff.index') }}" class="btn btn-default btn-sm">Cancel</a>
                                </div>

                            <!-- /.modal-content -->

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
