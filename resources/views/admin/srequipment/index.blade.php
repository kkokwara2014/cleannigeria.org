@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('srequipment.create') }}" class="btn btn-success btn-sm">
            <span class="fa fa-plus"></span> Add SR Equipment
        </a>
        {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-equip"
            data-backdrop="static" data-keyboard="false">
            <span class="fa fa-plus"></span> Add SR Equipment
        </button> --}}
        <a href="{{url('dashboard/equipment/approved')}}" class="btn btn-primary btn-sm">
            <span class="fa fa-eye"></span> Approved SR Equipment
        </a>
        <a href="{{url('dashboard/equipment/unapproved')}}" class="btn btn-warning btn-sm">
            <span class="fa fa-eye"></span> Unapproved SR Equipment
        </a>
        @if ($user->role->id==1||$user->role->id==2)
        <a href="{{url('dashboard/equipment')}}" class="btn btn-success btn-sm">
            <span class="fa fa-eye"></span> All SR Equipment
        </a>
        <a href="{{ route('scrap.index') }}" class="btn btn-info btn-sm">
            <span class="fa fa-eye"></span> Scrapped SR Equipment
        </a>

        @endif
        <br><br>

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
                                    <th>Ref #</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Store</th>
                                    <th>Qty.</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Approved?</th>
                                    <th>View Details</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($srequipments as $srequipment)

                                @if (auth()->user()->id==$srequipment->user_id || auth()->user()->role->id==1||
                                auth()->user()->role->id==2)
                                <tr>
                                    <td>{{$srequipment->refnumb}}</td>
                                    <td>{{$srequipment->name}}</td>
                                    <td>{{$srequipment->category->name}}</td>
                                    <td>{{$srequipment->store->name}} in {{ $srequipment->store->location->name }}</td>
                                    <td>{{$srequipment->qty.' '.$srequipment->itemunit->name}}</td>
                                    <td>{{$srequipment->status}}</td>
                                    <td><span class="badge badge-pill"
                                            style="background-color: rgb(24, 117, 170); color: whitesmoke">{{$srequipment->created_at->diffForHumans()}}</span>
                                    </td>
                                    <td>
                                        @if ($srequipment->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('srequipment.show',$srequipment->slug) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a>
                                    </td>
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if ($srequipment->isapproved==0)
                                                <form id="approve-{{$srequipment->slug}}" style="display: none"
                                                    action="{{ route('equipment.confirm',$srequipment->id) }}"
                                                    method="post">
                                                    @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$srequipment->slug}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif


                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('srequipment.edit',$srequipment->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$srequipment->id}}" style="display: none"
                                                    action="{{ route('srequipment.destroy',$srequipment->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$srequipment->id}}').submit();
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
                            <tfoot>
                                <tr>
                                    <th>Ref #</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Store</th>
                                    <th>Qty.</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Approved?</th>
                                    <th>View Details</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>


                         {{-- Data input modal area for equipment creation --}}
                         <div class="modal fade" id="modal-default-equip">
                            <div class="modal-dialog modal-lg">

                                <form action="{{ route('srequipment.store') }}" method="post">
                                    @csrf

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><span class="fa fa-cubes"></span> Add
                                                SREquipment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <label for="">Ref. Number</label>
                                                <input
                                                    style="background-color: green; color:floralwhite; font-size: 22px"
                                                    class="form-control" type="text" name="refnumb"
                                                    value="{{rand(234567, 994559)}}" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Name *</label>
                                                        <input type="text"
                                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            name="name" placeholder="Equipment Name" autofocus
                                                            value="{{ old('name') }}">
                                                        @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <span
                                                                style="color: red">{{ $errors->first('name','Enter Equipment Name') }}</span>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Matric. Number</label>
                                                        <input type="text" class="form-control"
                                                            name="matricnumb" placeholder="Matric Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Serial Number</label>
                                                        <input type="text" class="form-control"
                                                            name="serialnumb" placeholder="Serial Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Model Number</label>
                                                        <input type="text" class="form-control" name="modelnumb"
                                                            placeholder="Model Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Manufacturing Date</label>
                                                        <input id="datepicker" type="text" class="form-control"
                                                            name="manufacdate" placeholder="Manufacturing Date">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Quantity *</label>
                                                        <input type="text"
                                                            class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                                            name="qty" placeholder="Quantity" autofocus
                                                            value="{{ old('qty') }}">
                                                        @if ($errors->has('qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <span
                                                                style="color: red">{{ $errors->first('qty','Enter Equipment Quantity') }}</span>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="form-group has-feedback{{ $errors->has('status')?'has-error':'' }}">
                                                        <label for="">Status *</label>
                                                        <select name="status" class="form-control">
                                                            <option selected="disabled">Select Equipment Status
                                                            </option>

                                                            <option value="Functional">Functional</option>
                                                            <option value="Non Functional">Non Functional
                                                            </option>

                                                        </select>
                                                        @if ($errors->has('status'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <span
                                                                style="color: red">{{ $errors->first('status','Enter Equipment Status') }}</span>
                                                        </span>
                                                        @endif

                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Category *</label>
                                                        <select name="category_id" class="form-control">
                                                            <option selected="disabled">Select Category</option>
                                                            @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">
                                                                {{$category->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Store *</label>
                                                        <select name="store_id" class="form-control">
                                                            <option selected="disabled">Select Store</option>
                                                            @foreach ($stores as $store)
                                                            <option value="{{$store->id}}">
                                                                {{$store->name.' in '.$store->location->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Unit *</label>
                                                        <select name="itemunit_id" class="form-control">
                                                            <option selected="disabled">Select Unit</option>
                                                            @foreach ($itemunits as $itemunit)
                                                            <option value="{{$itemunit->id}}">
                                                                {{$itemunit->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Supplier *</label>
                                                        <select name="supplier_id" class="form-control">
                                                            <option selected="disabled">Select Supplier</option>
                                                            @foreach ($suppliers as $supplier)
                                                            <option value="{{$supplier->id}}">
                                                                {{$supplier->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea name="description" id="" cols="30" rows="2"
                                                            class="form-control"
                                                            value="{{ old('description') }}"
                                                            placeholder="Description">
                                </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <textarea name="remarks" id="" cols="30" rows="2"
                                                            class="form-control" value="{{ old('remarks') }}"
                                                            placeholder="Remarks">
                                </textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->

                                </form>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

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
