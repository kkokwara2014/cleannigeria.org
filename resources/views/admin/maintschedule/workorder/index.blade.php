@extends('admin.layout.app')

@section('title')
   All Work Orders
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
                {{--  <p>
                    <a href="{{ route('workorders.create') }}" class="btn btn-success btn-sm"><span class="fa fa-user"></span> Add workorder</a>
                </p>  --}}
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
                                        <th>Vendor</th>
                                        <th>Created</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workorders as $workorder)
                                    @if($workorder->user_id==auth()->user()->id ||auth()->user()->role->id==1||Auth::user()->role->id==2)
                                    <tr>
                                        <td>{{$workorder->uniquecode}}</td>
                                        <td>{{$workorder->srequipment->name}}</td>
                                        <td>{{$workorder->vendor->vendorname}}</td>
                                        <td>{{$workorder->created_at->diffForHumans()}}</td>
                                                                                
                                        <td>{{$workorder->user->firstname.' '.$workorder->user->lastname}}</td>
                                        <td>
                                            @if ($workorder->isapproved1==1 && $workorder->isapproved2==1)
                                            <span class="badge badge-pill badge-primary"
                                            style="background-color: green; color:whitesmoke"><span
                                                class="fa fa-check-o"></span> 
                                                Approved!
                                            </span>
                                            @else
                                            <span class="badge badge-pill badge-primary"
                                        style="background-color: red; color:whitesmoke"><span
                                            class="fa fa-check-o"></span> 
                                            Not Approved!
                                        </span>
                                                
                                            @endif
                                        </td>
                                        <td><a href="{{ route('workorder.show',$workorder->id) }}"><span
                                            class="fa fa-eye fa-2x text-primary"></span></a>
                                        </td>
                                        <td>
                                            <div class="dropdown"> <button type="button"
                                                    class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                    data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                    
                                                    @if ($workorder->isapproved1==0 && $workorder->user_id==auth()->user()->id)
                                                                                        
                                                        <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                                href="{{ route('workorder.edit',$workorder->id) }}"><span
                                                                    class="fa fa-pencil-square"></span> Edit</a> 
                                                        </li>
                                                        
                                                        <form id="remove-{{$workorder->id}}" style="display: none"
                                                            action="{{ route('workorder.destroy',$workorder->id) }}"
                                                            method="post">
                                                            {{ csrf_field() }}
                                                            {{method_field('DELETE')}}
                                                        </form>
        
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="" onclick="
                                                                            if (confirm('Delete this?')) {
                                                                                event.preventDefault();
                                                                            document.getElementById('remove-{{$workorder->id}}').submit();
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
