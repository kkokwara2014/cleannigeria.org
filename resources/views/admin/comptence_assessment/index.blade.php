@extends('admin.layout.app')

@section('title')
All Competence Assessments
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
                <p>
                    @if (Auth::user()->hasAnyRole(['Admin']))
                        <a href="{{ route('competenceassessment.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus-circle"></span> Add Competence Assessment</a>
                    @endif
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Caption</th>
                                    <th>Assessment Year</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comptasses as $compassessment)
                                <tr>

                                    <td>{{$compassessment->title.' '.$compassessment->assessmentyear}}</td>
                                    <td>{{$compassessment->assessmentyear}}</td>
                                    <td>{{$compassessment->starting}}</td>
                                    <td>{{$compassessment->ending}}</td>
                                    <td>
                                        @if ($compassessment->published==1)
                                        <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell"> Published</span>
                                        @else
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: crimson; color:seashell"> Unpublished</span>
                                            
                                        @endif
                                    </td>

                                    <td>
                                        {{$compassessment->user->firstname.' '.$compassessment->user->lastname}}
                                    </td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if(auth()->user()->hasAnyRole(['Admin']))
                                                @if ($compassessment->published==0)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('compassessment.publish',$compassessment->id) }}"><span
                                                            class="fa fa-bullhorn"></span> Publish</a> </li>
                                                    
                                                @else
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                    href="{{ route('compassessment.unpublish',$compassessment->id) }}"><span
                                                        class="fa fa-bullseye"></span> Unpublish</a> 
                                                </li>
                                                @endif

                                                @if ($compassessment->published==0)
                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('competenceassessment.edit',$compassessment->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$compassessment->id}}" style="display: none"
                                                    action="{{ route('competenceassessment.destroy',$compassessment->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$compassessment->id}}').submit();
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
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Caption</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
                                    <th>Created By</th>
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