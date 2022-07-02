@extends('admin.layout.app')
@section('title')
<span class="fa fa-cubes"></span> Add SREquipment
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        
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

                        <form action="{{ route('srequipment.store') }}" method="post">
                            @csrf
                            <div>
                                <label for="">Ref. Number</label>
                                <input style="background-color: green; color:floralwhite; font-size: 22px"
                                    class="form-control" type="text" name="refnumb" value="{{ $equipnumb }}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <i style="color:red;">*</i></label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" placeholder="Equipment Name" autofocus value="{{ old('name') }}"
                                            required>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('name') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Matric. Number</label>
                                        <input type="text" class="form-control" name="matricnumb"
                                            placeholder="Matric Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Serial Number</label>
                                        <input type="text" class="form-control" name="serialnumb"
                                            placeholder="Serial Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Model Number</label>
                                        <input type="text" class="form-control" name="modelnumb"
                                            placeholder="Model Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Manufacturing Date</label>
                                        <input id="datepicker" type="text" class="form-control" name="manufacdate"
                                            placeholder="Manufacturing Date">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quantity <i style="color:red;">*</i></label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                            name="qty" placeholder="Quantity" autofocus value="{{ old('qty') }}"
                                            required>
                                        @if ($errors->has('qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('qty') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback{{ $errors->has('status')?'has-error':'' }}">
                                        <label>Status <i style="color:red;">*</i></label>
                                        <select name="status" class="form-control" required>
                                            <option selected="disabled">Select Equipment Status
                                            </option>

                                            <option value="Functional">Functional</option>
                                            <option value="Non Functional">Non Functional
                                            </option>

                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('status') }}</span>
                                        </span>
                                        @endif

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Category <i style="color:red;">*</i></label>
                                        <select name="category_id" class="form-control" required>
                                            <option selected="disabled">Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Store <i style="color:red;">*</i></label>
                                        <select name="store_id" class="form-control" required>
                                            <option selected="disabled">Select Store</option>
                                            @foreach ($stores as $store)
                                            <option value="{{$store->id}}">
                                                {{$store->name.' in '.$store->location->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Unit <i style="color:red;">*</i></label>
                                        <select name="itemunit_id" class="form-control" required>
                                            <option selected="disabled">Select Unit</option>
                                            @foreach ($itemunits as $itemunit)
                                            <option value="{{$itemunit->id}}">
                                                {{$itemunit->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier <i style="color:red;">*</i></label>
                                        <select name="supplier_id" class="form-control" required>
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
                                        <textarea name="description" id="" cols="30" rows="2" class="form-control"
                                            value="{{ old('description') }}" placeholder="Description">
                                                </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <textarea name="remarks" id="" cols="30" rows="2" class="form-control"
                                            value="{{ old('remarks') }}" placeholder="Remarks">
                                                </textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <a href="{{ route('equipment') }}" class="btn btn-sm btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    
                        </form>

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
