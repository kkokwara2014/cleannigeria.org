@extends('admin.layout.app')

@section('title')
    Document Registers
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            @if (Auth::user()->hasAnyRole(['Document Registrar']) || auth()->user()->hasAnyRole(['Admin']))
            <a href="{{ route('documentregisters.create') }}" class="btn btn-success btn-sm">
                <span class="fa fa-file-pdf-o"></span> Add Document
            </a>
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
                                    <th>Title</th>
                                    <th>Doc. No.</th>
                                    <th>Date prepared</th>
                                    <th>Status</th>
                                    <th>Creator</th>                                    
                                    <th>View Details</th>
                                    <th>View Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterdocregisters as $docum)
                                <tr>
                                    <td>
                                        @if (strlen($docum->doctitle)>35)
                                        {{substr($docum->doctitle,0,35).'...'}}
                                        <small><a href="{{ route('documentregisters.show',$docum->slug) }}">Read more</a></small>
                                        @else
                                        {{ $docum->doctitle }}
                                            
                                        @endif
                                    </td>
                                    <td>{{ $docum->docnumber }}</td>
                                    <td>{{ $docum->dateprepared }}</td>

                                    <td>
                                        @if ($docum->isapproved=='0')
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
                                                                        
                                    <td>{{ $docum->user->firstname.' '.strtoupper($docum->user->lastname) }}</td>
                                    <td><a href="{{ route('documentregisters.show',$docum->slug) }}"><span
                                        class="fa fa-eye fa-2x text-primary"></span></a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ route('viewmasterdocregister',$docum->filename) }}">
                                            <span class="fa fa-file-pdf-o fa-2x text-primary text-danger"></span>
                                        </a>
                                    </td>
                                    
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-block btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                                <form id="approve-{{$docum->id}}" style="display: none"
                                                    action="{{ route('documregister.approve',$docum->id) }}" method="post">
                                                    @csrf
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$docum->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                ">
                                                        <span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif

                                                @if (Auth::user()->id==5)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('documentregisters.edit',$docum->slug) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$docum->id}}" style="display: none"
                                                    action="{{ route('documentregisters.destroy',$docum->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$docum->id}}').submit();
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

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Doc. No.</th>
                                    <th>Date prepared</th>
                                    <th>Status</th>
                                    <th>Creator</th>                                    
                                    <th>View</th>
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
