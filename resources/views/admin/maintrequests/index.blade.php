@extends('admin.layout.app')

@section('title')
Maintenance Requests
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">

                {{-- @if ($user->staffcategory_id==3) --}}
                <p>
                    <a href="{{ route('maintenancerequest.create') }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-plus"></span> Make Maintenance Request</a>
                </p>
                {{-- @endif --}}

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Notifier/Phone</th>
                                    <th>Maint. Code</th>
                                    <th>Requested on</th>
                                    <th>Expected Maint. Date</th>
                                    <th>Status</th>
                                    <th>View Details</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintrequests as $maintrequest)
                                @if ($maintrequest->user_id==auth()->user()->id || auth()->user()->hasAnyRole(['Admin'])
                                || auth()->user()->hasAnyRole(['General Manager'])
                                || auth()->user()->hasAnyRole(['Maintenance Officer']))
                                <tr>
                                    <td>
                                        {{$maintrequest->user->firstname.' '.$maintrequest->user->lastname}}
                                        &nbsp;
                                        <a
                                            href="tel:{{ $maintrequest->user->phone }}">{{ $maintrequest->user->phone }}</a>
                                    </td>

                                    <td>
                                        {{ $maintrequest->maintcode }}
                                    </td>
                                    <td>
                                        {{ $maintrequest->dateofrequest }}
                                    </td>
                                    <td>
                                        {{ date('d M, Y',strtotime($maintrequest->expectedmaintdate)) }}
                                    </td>
                                    <td>
                                        @if ($maintrequest->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('maintenancerequest.show',$maintrequest) }}"><span
                                                class="fa fa-eye fa-2x"></span></a>
                                    </td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                id="dropdownMenu1" data-toggle="dropdown"> Action &nbsp;&nbsp;<span
                                                    class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (auth()->user()->hasAnyRole(['Admin']) ||
                                                ($maintrequest->user_id==auth()->user()->id))

                                                    @if ($maintrequest->isapproved==0)
                                                    <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                            href="{{ route('maintenancerequest.edit',$maintrequest) }}"><span
                                                                class="fa fa-pencil-square"></span> Edit</a>
                                                    </li>

                                                    <form id="remove-{{$maintrequest->id}}" style="display: none"
                                                        action="{{ route('maintenancerequest.destroy',$maintrequest->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>

                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="" onclick="
                                                                                if (confirm('Delete this?')) {
                                                                                    event.preventDefault();
                                                                                document.getElementById('remove-{{$maintrequest->id}}').submit();
                                                                                } else {
                                                                                    event.preventDefault();
                                                                                }
                                                                            "><span class="fa fa-trash-o"></span>
                                                            Delete
                                                        </a>
                                                    </li>
                                                    @endif
                                                @endif

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                            </tbody>

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