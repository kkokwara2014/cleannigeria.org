@extends('admin.layout.app')

@section('title')
Biometric Scanner Locations
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
                    <a href="javascript:void(0)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create_modal">
                        <span class="fa fa-plus"></span> Create Location
                    </a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
                <div class="box">
                

                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Scanner Location</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($locations as $location)

                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$location->name}}</td>
                                    <td>
                                        <a href="{{ route('bio.timesys', ['location'=>$location->id]) }}" target="_blank" class="btn btn-sm btn-primary">Open For Scanning</a>                    
                                        
                                        <form id="remove-{{$location->id}}" style="display: none"
                                            action="{{ route('scanner.destroy',$location->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a href="" onclick="
                                                        if (confirm('Delete this?')) {
                                                            event.preventDefault();
                                                        document.getElementById('remove-{{$location->id}}').submit();
                                                        } else {
                                                            event.preventDefault();
                                                        }
                                                    ">
                                                    <button type="button" class="btn btn-sm btn-danger"><span class="fa fa-trash-o"></span>
                                                    Delete</button>
                                                            
                                        </a>
                                       

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Scanner Location</th>
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

<div class="modal fade" id="create_modal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create Scanner Location</h4>
        </div>
        <form action="{{route('scanner.store')}}" method="post">
            <div class="modal-body">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Company</label>
                            <select name="company_id" class="company_id form-control" required>
                                <option value="select" selected="disabled">Select Company</option>
                                @foreach ($companies as $item)
                                <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="control-label">Location Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Warehouse">
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>        
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection