@extends('admin.layout.app')

@section('title')
    Certificates
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('certificates.create') }}" class="btn btn-success btn-sm">
                <span class="fa fa-certificate"></span> Add Certificate
            </a>

            <a href="{{ route('trainees.index') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-users"></span> All Trainees
            </a>
            <a href="{{ route('trainings.index') }}" class="btn btn-warning btn-sm">
                <span class="fa fa-users"></span> All Trainings
            </a>
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
                                    <th>Trainee</th>
                                    <th>Cert. No.</th>
                                    <th>Unique Code</th>
                                    <th>Issued</th>
                                    <th>Valid Till</th>
                                    <th>Status</th>
                                    <th>Creator</th>
                                    <th>Gen. Cert.</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificates as $cert)
                                <tr>
                                    <td>{{ $cert->trainee->firstname.' '.strtoupper($cert->trainee->lastname) }}</td>
                                    <td>{{ $cert->certnumber }}</td>
                                    <td>{{ $cert->uniquecode }}</td>
                                    <td>{{ date('d M, Y',strtotime($cert->issuedon)) }}</td>
                                    <td>{{ date('d M, Y',strtotime($cert->validityperiod)) }}</td>
                                    <td>
                                        @if ($cert->isapproved=='0')
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell">
                                            Not Approved
                                        </span>
                                        @else
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell">
                                             Approved
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $cert->user->firstname.' '.$cert->user->lastname }}</td>
                                    {{-- <td>
                                        <a href="{{ route('download.certificate',$cert->filename) }}" download="{{ $cert->filename }}">
                                            <span class="fa fa-file-pdf-o" style="color: red"></span>  <span class="fa fa-download" style="color: green"></span> 
                                        </a>
                                    </td> --}}
                                    <td style="text-align: center">
                                        @if ($cert->isapproved=='1')
                                        <a target="_blank" href="{{ route('generate.certificate',$cert->id) }}" title="Generate & Send">
                                            <span class="fa fa-certificate" style="color: red"></span> <span class="fa fa-send"></span> 
                                        </a>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-block btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role_id<=3)

                                                <li role="presentation"> <a target="_blank" role="menuitem" tabindex="-1"
                                                    href="{{ route('certificates.show',$cert->id) }}"><span
                                                        class="fa fa-eye"></span> View</a> </li>

                                                <form id="approve-{{$cert->id}}" style="display: none"
                                                    action="{{ route('certificate.approve',$cert->id) }}" method="post">
                                                    @csrf
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$cert->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('certificates.edit',$cert->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$cert->id}}" style="display: none"
                                                    action="{{ route('certificates.destroy',$cert->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$cert->id}}').submit();
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
