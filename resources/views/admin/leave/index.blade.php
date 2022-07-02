@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            @if ($user->leaveent!=0)
            <a class="btn btn-success btn-sm" href="{{ route('leave.create') }}"><span class="fa fa-plus"></span> Leave
                Request</a>
            @endif
               &nbsp;&nbsp;
           @if ($user->staffcategory_id==1)
           Dear <strong>{{ $user->firstname.' '.$user->lastname }}</strong>, you have
           <strong>{{ $user->leaveent }}</strong> working days
           leave entitlement this year.
           @elseif($user->staffcategory_id==2)
           Dear <strong>{{ $user->firstname.' '.$user->lastname }}</strong>, you have
           <strong>{{ $user->leaveent }}</strong> calendar days
           leave entitlement this year.
           @endif
   
          @if ($leavetobeapprovebyme>0)
           <span style="float: right">Your Approved Leaves : {{ $totalleavesapprovedbyyou }}
               &nbsp;&nbsp;<a href="{{ route('track.approvedleaves') }}">View</a>
           </span> 
          @endif
           
        </p>
       

        <div class="row">
            <div class="col-md-12">


                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>By</th>

                                    <th>Type</th>
                                    <th>Req. Days</th>
                                    <th>Rem. Days</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Approver</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                @if($user->id==$leave->user_id|| $user->id==$leave->sendto_id ||Auth::user()->hasAnyRole(['Admin']))
                                <tr>
                                    <td>{{$leave->user->firstname.' '.$leave->user->lastname}}</td>
                                    <td>{{$leave->leavetype->name}}</td>
                                    <td>{{$leave->numofdays}}</td>
                                    <td>{{$leave->user->leaveent}}</td>
                                    <td>{{$leave->starting}}</td>
                                    <td>{{$leave->ending}}</td>
                                    <td>
                                        @if ($leave->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('leave.show',$leave->id) }}"><span class="fa fa-2x fa-eye"></span></a>
                                    </td>
                                    <td>
                                       @foreach ($leaveapprovers as $approver)
                                            @if ($approver->id==$leave->sendto_id)
                                                {{$approver->firstname.' '.$approver->lastname}}
                                            @endif
                                       @endforeach
                                    </td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if ($user->id==$leave->sendto_id ||Auth::user()->hasAnyRole(['Admin']))
                                                <form id="approve-{{$leave->id}}" style="display: none"
                                                    action="{{ route('leave.confirm',$leave->id) }}" method="post">
                                                    @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$leave->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @if ($leave->isapproved==0)
                                                
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('leave.edit',$leave->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$leave->id}}" style="display: none"
                                                    action="{{ route('leave.destroy',$leave->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$leave->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>
                                            @endif
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>By</th>
                                    <th>Type</th>
                                    <th>Req. Days</th>
                                    <th>Rem. Days</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot> --}}
                        </table>
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