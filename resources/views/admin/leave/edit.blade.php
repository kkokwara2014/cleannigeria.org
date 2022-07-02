@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        
        <p>
            <a href="{{ route('leave.index') }}" class="btn btn-success btn-sm">
               <span class="fa fa-eye"></span> All Leaves
            </a>
        </p>
        

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('leave.update',$leaves->id) }}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">To *</label>
                                        <select name="sendto_id" class="form-control" required>
                                            <option selected="disabled">Select Approver</option>
                                            @foreach ($senttos as $sentto)
                                            <option value="{{$sentto->id}}" {{ $sentto->id== $leaves->sendto_id?'selected':'' }}>
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
                                            <option value="{{$leavetype->id}}" {{ $leavetype->id== $leaves->leavetype_id?'selected':'' }}>{{$leavetype->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Title *</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                            name="title" placeholder="Leave Title" autofocus value="{{ $leaves->title }}">
                                        @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('title','Enter Leave Title') }}</span>
                                        </span>
                                        @endif
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="">Starting Date</label>
                                        <input id="datepicker" type="text"
                                            class="form-control{{ $errors->has('starting') ? ' is-invalid' : '' }}"
                                            name="starting" placeholder="Starting Date" value="{{ $leaves->starting }}">
                                        @if ($errors->has('starting'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('starting','Select starting date') }}</span>
                                        </span>
                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ending Date</label>
                                        <input id="datepicker1" type="text"
                                            class="form-control{{ $errors->has('ending') ? ' is-invalid' : '' }}"
                                            name="ending" placeholder="Ending Date" value="{{ $leaves->ending }}">
                                        @if ($errors->has('ending'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('ending','Select ending date') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Number of Days</label>
                                        <input id="numofdays" type="text" class="form-control" name="numofdays"
                                            placeholder="Number of Days" readonly value="{{ $leaves->numofdays }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                            placeholder="Brief Description">{{ $leaves->description }}
                                                                </textarea>
                                    </div>


                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <br>
                            <a href="{{ route('leave.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

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
