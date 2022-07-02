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

             <span style="float: right; font-weight: bolder; font-size: 25px;">Total : {{ $totalleavesapprovedbyyou }}</span>
        </p>
        

        <div class="row">
            <div class="col-md-12">
                

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                {{ $leavesapprovedbyyou->links() }}

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        @foreach ($leavesapprovedbyyou as $lappbyyou)
                           {{--  {{ $lappbyyou }}  --}}

                           <ul class="list-group">

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="#">
                                                    <img src="{{url('user_images',$lappbyyou->user->userimage)}}" alt=""
                                                        class="img-responsive img-circle" style="border-radius: 50%"
                                                        width="60" height="60">
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <div>
                                                    Approved? :
                                                    @if ($lappbyyou->isapproved==1)
                                                    <span class="badge badge-success badge-pill"
                                                        style="background-color: green; color:seashell"> Yes</span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill"
                                                        style="background-color: red; color:seashell"> No</span>
            
                                                    @endif
                                                </div>
                                                
                                                <div>
                                                    Approved On : {{date('d M, Y',strtotime($lappbyyou->updated_at))}}
                                                </div>
                                                <div>
                                                    Starting : {{date('d M, Y',strtotime($lappbyyou->starting))}}
                                                    &nbsp;
                                                    & 
                                                    &nbsp;
                                                    Ending : {{date('d M, Y',strtotime($lappbyyou->ending))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </li>
                        </ul>

                       @endforeach
                        
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
                        Dear {{ $user->firstname.' '.$user->lastname }}, you have {{ $user->leaveent }} working days
                        leave entitlement this year.
                        @else
                        Dear {{ $user->firstname.' '.$user->lastname }}, you have {{ $user->leaveent }} calendar days
                        leave entitlement this year.
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