@extends('admin.layout.app')

@section('title')
    Maintenance Schedule
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
                    {{--  <a href="{{ route('maintenanceschedule.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus-circle"></span> Schedule Equipment</a>  --}}
                    <a href="{{ route('select.maintoption') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus-circle"></span> Schedule Equipment</a>
                    {{--  <a href="{{ route('maintdequip.unapproved') }}" class="btn btn-warning btn-sm"><span class="fa fa-question-circle-o"></span> Unapproved Maintained Equipment</a>  --}}
                    {{--  <a href="{{ route('maintdequip.approved') }}" class="btn btn-success btn-sm"><span class="fa fa-check-circle-o"></span> Approved Maintained Equipment</a>  --}}
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')
    
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
    
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Equipment</th>
                                        <th>Maint. Cycle</th>
                                        <th>Due for Maint.</th>
                                        <th>Status</th>
                                        <th>Scheduler</th>
                                        <th>Created</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintschedules as $maintschedule)
                                    @if($maintschedule->user_id==auth()->user()->id ||Auth::user()->role->id==1||Auth::user()->role->id==2)
                                    <tr>
                                        <td>{{$maintschedule->schedulecode}}</td>
                                        <td>{{$maintschedule->srequipment->name}}</td>
                                        <td>
                                            @if ($maintschedule->maintcycle==1)
                                                {{$maintschedule->maintcycle.' month'}}
                                            @else
                                                {{$maintschedule->maintcycle.' months'}}    
                                            @endif
                                        </td>
                                        <td>{{$maintschedule->duedateformaint}}</td>
                                        
                                        <td>
                                            @if ($maintschedule->ismaintained==1)
                                            <span class="badge badge-success badge-pill"
                                                style="background-color: green; color:seashell"> Maintained</span>
                                            @else
                                            <span class="badge badge-danger badge-pill"
                                                style="background-color: crimson; color:seashell"> Not Maintained</span>
    
                                            @endif
                                        </td>
                                        <td>{{$maintschedule->user->firstname.' '.$maintschedule->user->lastname}}</td>
                                        <td>{{$maintschedule->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{ route('maintenanceschedule.show',$maintschedule->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a>
                                        </td>
                                        <td>
                                            <div class="dropdown"> <button type="button"
                                                    class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                    data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    
                                                    @if ($maintschedule->ismaintained==0)
                                                    {{--  <li role="presentation"> 
                                                        <a role="menuitem" tabindex="-1"
                                                            href="{{ route('create.maintdequipment',$maintschedule->id) }}"><span
                                                                class="fa fa-plus"></span> Mtd. Equipt.</a> 
                                                    </li>  --}}
                                                    <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                            href="{{ route('maintenanceschedule.edit',$maintschedule->id) }}"><span
                                                                class="fa fa-pencil-square"></span> Edit</a> 
                                                    </li>
                                                    @endif
    
                                                    <form id="remove-{{$maintschedule->id}}" style="display: none"
                                                        action="{{ route('maintenanceschedule.destroy',$maintschedule->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{method_field('DELETE')}}
                                                    </form>
    
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="" onclick="
                                                                        if (confirm('Delete this?')) {
                                                                            event.preventDefault();
                                                                        document.getElementById('remove-{{$maintschedule->id}}').submit();
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
