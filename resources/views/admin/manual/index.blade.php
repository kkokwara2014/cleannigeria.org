@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-11">

               <p> <a href="{{route('manuals.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Add Manual</a></p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                   
                                    <th>Title</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manuals as $nw)
                                <tr>
                                    
                                    <td>{{$nw->title}}</td>
                                    <td>{{$nw->user->firstname.' '.$nw->user->lastname}}</td>
                                    <td>
                                        @if ($nw->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Unapproved</span>

                                        @endif
                                    </td>
                                    <td>
                                        @if ($nw->isapproved==1)
                                        <a target="_blank" href="{{url('/public/storage/equipmentmanuals/'.$nw->filename)}}">
                                            <span class="fa fa-file-pdf-o fa-2x" style="color: red"></span>
                                        </a>
                                        @else
                                            Waiting approval...
                                        @endif
                                    </td>
                                    <td>  
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)

                                                @if ($nw->isapproved==0)
                                                <form id="approve-{{$nw->id}}" style="display: none"
                                                    action="{{ route('manuals.approve',$nw->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$nw->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @endif

                                                @if($nw->isapproved==0)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('manuals.edit',$nw->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>
                                                    
                                                @endif


                                                <form id="remove-{{$nw->id}}" style="display: none"
                                                    action="{{ route('manuals.destroy',$nw->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$nw->id}}').submit();
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
                            <tfoot>
                                <tr>
                                  
                                    <th>Title</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>File</th>
                                   
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
