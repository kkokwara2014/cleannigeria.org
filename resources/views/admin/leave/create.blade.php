@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-leave"
            data-backdrop="static" data-keyboard="false">
            <span class="fa fa-plus"></span> Leave Request
        </button> --}}
       <p>
           <a class="btn btn-success btn-sm" href="{{ route('leave.index') }}"><span class="fa fa-eye"></span> All Leave
               Request</a>
       </p>
       

        <div class="row">
            <div class="col-md-12">


                @include('admin.messages.success')
                @include('admin.messages.deleted')
                @include('admin.messages.refusal')

                {{-- @if (Session::has('msg'))
                <span class="alert alert-danger" style="color: red">{{ Session::get('msg') }}</span>
                @endif --}}

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if ($user->staffcategory_id==1)
                        Dear <strong>{{ $user->firstname.' '.$user->lastname }}</strong>, you have
                        <strong>{{ $user->leaveent }}</strong> working days
                        leave entitlement this year.
                        @else
                        Dear <strong>{{ $user->firstname.' '.$user->lastname }}</strong>, you have
                        <strong>{{ $user->leaveent }}</strong> calendar days
                        leave entitlement this year.
                        @endif

                        {{-- calculating total leave entitlement taken --}}
                        {{-- @foreach ($takenleaveents as $tle)
                            {{ $tle->sum('numofdays') }}
                        @endforeach --}}
                        <br>

                        <br>
                        @if ($user->leaveent>0)
                        <form action="{{ route('leave.store') }}" method="post">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">To <strong style="color: red">*</strong></label>
                                        <select name="sendto_id" class="form-control" required>
                                            <option selected="disabled">Select Approver</option>
                                            @foreach ($senttos as $sentto)
                                            <option value="{{$sentto->id}}">
                                                {{$sentto->email.' ['.$sentto->firstname.' '.$sentto->lastname.' ]'}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Leave Type <strong style="color: red">*</strong></label>
                                        <select name="leavetype_id" class="form-control" required>
                                            <option selected="disabled">Select Leave Type</option>
                                            @foreach ($leavetypes as $leavetype)
                                            <option value="{{$leavetype->id}}">{{$leavetype->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Starting Date <strong style="color: red">*</strong></label>
                                        <input id="datepicker" type="text"
                                            class="form-control{{ $errors->has('starting') ? ' is-invalid' : '' }}"
                                            name="starting" placeholder="Starting Date">
                                        @if ($errors->has('starting'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('starting','Select starting date') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ending Date <strong style="color: red">*</strong></label>
                                        <input id="datepicker1" type="text"
                                            class="form-control{{ $errors->has('ending') ? ' is-invalid' : '' }}"
                                            name="ending" placeholder="Ending Date">
                                        @if ($errors->has('ending'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('ending','Select ending date') }}</span>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Number of Days</label>
                                        <input id="numofdays" type="text" class="form-control" name="numofdays"
                                            placeholder="Number of Days" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description <strong style="color: red">*</strong></label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                            value="{{ old('description') }}" placeholder="Brief Description">
                                                                        </textarea>
                                    </div>


                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


                            <a href="{{ route('leave.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>

                        </form>
                        @else
                            <p class="badge badge-pill" style="background-color: red; color: whitesmoke;">Sorry! You can not request leave due to insufficient leave entitlement.</p>
                        @endif

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>


        {{-- Data input modal area for leave application --}}
        {{-- <div class="modal fade" id="modal-default-leave">
            <div class="modal-dialog modal-lg">



                <form action="{{ route('leave.store') }}" method="post">
        @csrf

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-hotel"></span> Apply Leave</h4>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        @if ($user->staffcategory_id==1)
                        Dear {{ $user->firstname.' '.$user->lastname }}, you have {{ $user->leaveent }}
                        working days
                        leave entitlement this year.
                        @else
                        Dear {{ $user->firstname.' '.$user->lastname }}, you have {{ $user->leaveent }}
                        calendar
                        days leave entitlement this year.
                        @endif

                    </div>
                    <br>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">To *</label>
                            <select name="sendto_id" class="form-control" required>
                                <option selected="disabled">Select Approver</option>
                                @foreach ($senttos as $sentto)
                                <option value="{{$sentto->id}}">
                                    {{$sentto->email.' ['.$sentto->firstname.' '.$sentto->lastname.' ]'}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Leave Type *</label>
                            <select name="leavetype_id" class="form-control" required>
                                <option selected="disabled">Select Leave Type</option>
                                @foreach ($leavetypes as $leavetype)
                                <option value="{{$leavetype->id}}">{{$leavetype->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Starting Date</label>
                            <input id="datepicker" type="text"
                                class="form-control{{ $errors->has('starting') ? ' is-invalid' : '' }}" name="starting"
                                placeholder="Starting Date">
                            @if ($errors->has('starting'))
                            <span class="invalid-feedback" role="alert">
                                <span style="color: red">{{ $errors->first('starting','Select starting date') }}</span>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Ending Date</label>
                            <input id="datepicker1" type="text"
                                class="form-control{{ $errors->has('ending') ? ' is-invalid' : '' }}" name="ending"
                                placeholder="Ending Date">
                            @if ($errors->has('ending'))
                            <span class="invalid-feedback" role="alert">
                                <span style="color: red">{{ $errors->first('ending','Select ending date') }}</span>
                            </span>
                            @endif
                        </div>


                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="">Number of Days</label>
                            <input id="numofdays" type="text" class="form-control" name="numofdays"
                                placeholder="Number of Days" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                value="{{ old('description') }}" placeholder="Brief Description">
                                                                </textarea>
                        </div>


                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->

        </form>
</div>
<!-- /.modal-dialog -->
</div> --}}
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
