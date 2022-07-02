@extends('admin.layout.app')

@section('title')
   All Vendors
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
                    <a href="{{ route('vendors.create') }}" class="btn btn-success btn-sm"><span class="fa fa-user"></span> Add Vendor</a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
    
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                       
                                        <th>Vendor</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Created</th>
                                        <th>Creator</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                    @if($vendor->user_id==auth()->user()->id ||Auth::user()->role->id==1||Auth::user()->role->id==2)
                                    <tr>
                                        <td>{{$vendor->vendorname}}</td>
                                        <td>{{$vendor->vendorphone}}</td>
                                        <td>{{$vendor->vendoraddress}}</td>
                                        <td>{{$vendor->created_at->diffForHumans()}}</td>
                                                                                
                                        <td>{{$vendor->user->firstname.' '.$vendor->user->lastname}}</td>
                                        
                                        <td>
                                            <div class="dropdown"> <button type="button"
                                                    class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                    data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    
                                                                                        
                                                    <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                            href="{{ route('vendors.edit',$vendor->id) }}"><span
                                                                class="fa fa-pencil-square"></span> Edit</a> 
                                                    </li>
                                                  
    
                                                    <form id="remove-{{$vendor->id}}" style="display: none"
                                                        action="{{ route('vendors.destroy',$vendor->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{method_field('DELETE')}}
                                                    </form>
    
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="" onclick="
                                                                        if (confirm('Delete this?')) {
                                                                            event.preventDefault();
                                                                        document.getElementById('remove-{{$vendor->id}}').submit();
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
