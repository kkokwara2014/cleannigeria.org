@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        <div class="row">
            <div class="col-md-12">

                <p>
                    <a href="{{route('hazardreports.create')}}" class="btn btn-primary btn-sm">Report Hazard</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Num.</th>
                                    <th>Risk</th>
                                    <th>Occurence Date/Time</th>
                                    <th>Location</th>
                                    <th>Observed By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hazards as $hazard)
                                {{-- @if($user->id==$hazard->user_id) --}}
                                <tr>
                                    <td>{{$hazard->uniquenum}}</td>
                                    <td>
                                        @if ($hazard->riskcategory=='High')
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"><span
                                                class="fa fa-bug"></span> High</span>
                                        @elseif($hazard->riskcategory=='Medium')
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: orange; color:seashell"><span
                                                class="fa fa-bug"></span> Medium</span>
                                        @else
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"><span
                                                class="fa fa-bug"></span> Low</span>
                                        @endif

                                    </td>
                                    <td>{{$hazard->dateofoccurence.' '.$hazard->timeofoccurence}}</td>
                                    <td>{{$hazard->location->name}}</td>
                                    <td>{{$hazard->user->firstname.' '.$hazard->user->lastname}}</td>

                                    <td>
                                        @if ($hazard->isclosed==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Closed</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Open</span>

                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                {{-- show menu if the report is open --}}
                                                @if ($hazard->isclosed==0)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('hazardreports.show',$hazard->id) }}"><span
                                                            class="fa fa-book"></span> Track</a> </li>
                                                @endif
                                                <li role="presentation"> <a role="menuitem" tabindex="-1" href="#"
                                                        data-toggle="modal" data-target="#modal-{{ $hazard->id }}"><span
                                                            class="fa fa-eye"></span> Recommendation</a> </li>

                                                {{-- show menu if the report is open --}}
                                                @if ($hazard->isclosed==0)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('hazardreports.closed',$hazard->id) }}"><span
                                                            class="fa fa-close"></span> Close</a> </li>

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('hazardreports.edit',$hazard->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$hazard->id}}" style="display: none"
                                                    action="{{ route('hazardreports.destroy',$hazard->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$hazard->id}}').submit();
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

                                <!--the modal for hazard recommendation-->
                                <div class="modal fade" id="modal-{{ $hazard->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <!--modal-sm-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong><span class="fa fa-bug"></span>
                                                        {{ $hazard->uniquenum }}</strong>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-justify">
                                                    <div>
                                                        Reported by:
                                                        <strong>{{ $hazard->user->firstname.' '.$hazard->user->lastname }}</strong>
                                                    </div>
                                                    <div>
                                                        Description: {{ $hazard->description }}
                                                    </div>
                                                    <div>
                                                        Reported on: {{ date('d M, Y',strtotime($hazard->created_at)) }}
                                                    </div>
                                                </p>
                                                <hr>

                                                @foreach ($actiontrackings as $actrack)

                                                @if ($actrack->hazardreport_id==$hazard->id)
                                                <p class="text-justify">
                                                    <div>
                                                        Responsible Party:
                                                        <strong>{{ $actrack->user->firstname.' '.$actrack->user->lastname }}</strong>
                                                    </div>
                                                    <div>
                                                        Proposed Closing Date: {{ $actrack->proposedclosingddate }}
                                                    </div>
                                                    <div>
                                                        Remark: {{ $actrack->remark }}
                                                    </div>
                                                    <div>
                                                        Date: {{ date('d M, Y', strtotime($actrack->created_at)) }}
                                                    </div>
                                                </p>
                                                <hr>

                                                @endif


                                                @endforeach

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div>

                                </div>
                                {{-- @endif --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Num.</th>
                                    <th>Risk</th>
                                    <th>Occurence Date/Time</th>
                                    <th>Location</th>
                                    <th>Observed By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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