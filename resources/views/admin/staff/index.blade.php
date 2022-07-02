@extends('admin.layout.app')
@section('title')
Staff Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        
        <p>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-staff"
                data-backdrop="static" data-keyboard="false">
                <span class="fa fa-plus"></span> Add Staff
            </button>
        </p>
        

        <div class="row">
            <div class="col-md-12">

                {{-- for messages --}}
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>Image</th> --}}
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>View Details</th>
                                    <th>Status</th>
                                   
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)

                                <tr>

                                    {{-- <td>
                                        <img src="{{url('user_images',$staff->userimage)}}" alt=""
                                            class="img-responsive img-rounded" width="40" height="40">
                                    </td> --}}
                                    <td>{{$staff->lastname}}</td>
                                    <td>{{$staff->firstname}}</td>
                                    <td>{{$staff->email}}</td>
                                    <td>{{$staff->phone}}</td>
                                    <td><a href="{{ route('staff.show',$staff->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>
                                    <td>
                                        @if ($staff->isactive==1)
                                        <span class="fa fa-check-circle fa-2x text-success"></span>
                                        @else
                                        <span class="fa fa-close fa-2x text-danger"></span>
                                        @endif

                                    </td>
                                  
                                    <td>


                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-success btn-sm btn-block dropdown-toggle"
                                                id="dropdownMenu1" data-toggle="dropdown"> Action &nbsp;&nbsp;<span
                                                    class="caret"></span> </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if ($staff->isactive==1)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('staff.deactivate',$staff->id) }}"><span
                                                            class="fa fa-close"></span> Deactivate</a> </li>
                                                @else
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('staff.activate',$staff->id) }}"><span
                                                            class="fa fa-check-circle-o"></span> Activate</a> </li>
                                                @endif

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('staff.edit',$staff->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>



                                                <form id="remove-{{$staff->id}}" style="display: none"
                                                    action="{{ route('staff.destroy',$staff->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                            if (confirm('Are you sure you want to delete this?')) {
                                                                                event.preventDefault();
                                                                            document.getElementById('remove-{{$staff->id}}').submit();
                                                                            } else {
                                                                                event.preventDefault();
                                                                            }
                                                                        "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                    </td>
                               
                                </tr>
                            
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>


        {{-- Data input modal area --}}
        <div class="modal fade" id="modal-default-staff">
            <div class="modal-dialog modal-lg">

                <form action="{{ route('staff.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="fa fa-users"></span> Add Staff</h4>
                        </div>
                        <div class="modal-body">

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
                                            name="email" value="{{ old('email') }}" autofocus placeholder="Email" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('email','Enter Email Address') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    
                                    {{-- <div class="form-group">
                                        <label for="">Password <strong style="color:red">*</strong></label>
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="Password">

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('password','Enter Password') }}</span>
                                        </span>
                                        @endif
                                    </div> --}}

                                </div>
                                <div class="col-md-6">

                                    {{-- <div class="form-group">
                                        <label for="">Repeat Password <strong style="color:red">*</strong></label>
                                        <input id="password-confirm" type="password"
                                            class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            name="password_confirmation" placeholder="Repeat Password">

                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('password_confirmation','Confirm Password') }}</span>
                                        </span>
                                        @endif
                                    </div> --}}

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

                                    <div class="form-group">
                                        <label for="">Staff Category <strong style="color:red;">*</strong></label>
                                        <select name="staffcategory_id" class="form-control">
                                            <option selected="disabled" value="" required>Select Staff Category</option>
                                            @foreach ($staffcategories as $staffcategory)
                                            <option value="{{$staffcategory->id}}">{{$staffcategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Staff Location <strong style="color:red;">*</strong></label>
                                        <select name="location_id" class="form-control">
                                            <option selected="disabled" value="" required>Select Staff Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            {{-- <div>
                                <label for="">Role <strong style="color:red;">*</strong></label>
                                <select name="role_id" class="form-control">
                                    <option value="" selected="disabled" required>Select Staff Role</option>
                                    @foreach ($staffroles as $staffrole)
                                    <option value="{{$staffrole->id}}">{{$staffrole->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->

                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


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
