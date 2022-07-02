@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{url('dashboard/equipment')}}" class="btn btn-primary btn-sm">
          Back
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('srequipment.update',$equipment->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div>
                                <label for="">Ref. Number</label>
                                <input style="background-color: green; color:floralwhite; font-size: 22px"
                                    class="form-control" type="text" name="refnumb" value="{{ $equipment->refnumb }}"
                                    readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name *</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" placeholder="Equipment Name" autofocus
                                            value="{{ $equipment->name }}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('name','Enter Equipment Name') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Matric. Number</label>
                                        <input type="text" class="form-control" name="matricnumb"
                                            value="{{ $equipment->matricnumb!=''?$equipment->matricnumb:'' }}" placeholder="Matric Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Serial Number</label>
                                        <input type="text" class="form-control" name="serialnumb"
                                            placeholder="Serial Number" value="{{ $equipment->serialnumb!=''?$equipment->serialnumb:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Model Number</label>
                                        <input type="text" class="form-control" name="modelnumb"
                                            placeholder="Model Number" value="{{ $equipment->modelnumb!=''?$equipment->modelnumb:'' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Manufacturing Date</label>
                                        <input id="datepicker" type="text" class="form-control" name="manufacdate"
                                            placeholder="Manufacturing Date" value="{{ $equipment->manufacdate}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quantity *</label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                            name="qty" placeholder="Quantity" autofocus value="{{ $equipment->qty }}">
                                        @if ($errors->has('qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('qty','Enter Equipment Quantity') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback{{ $errors->has('status')?'has-error':'' }}">
                                        <label for="">Status *</label>
                                        <select name="status" class="form-control">
                                            <option selected="disabled">Select Equipment Status</option>

                                            <option value="Functional" {{ $equipment->status=='Functional'?'selected':'' }}>Functional</option>
                                            <option value="Non Functional" {{ $equipment->status=='Non Functional'?'selected':'' }}>Non Functional</option>

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
                                            <option value="{{$category->id}}" {{ $category->id== $equipment->category_id?'selected':'' }}>{{$category->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Store *</label>
                                        <select name="store_id" class="form-control">
                                            <option selected="disabled">Select Store</option>
                                            @foreach ($stores as $store)
                                            <option value="{{$store->id}}" {{ $store->id== $equipment->store_id?'selected':'' }}>
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
                                            <option value="{{$itemunit->id}}" {{ $itemunit->id== $equipment->itemunit_id?'selected':'' }}>{{$itemunit->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Supplier *</label>
                                        <select name="supplier_id" class="form-control">
                                            <option selected="disabled">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" {{ $supplier->id== $equipment->supplier_id?'selected':'' }}>{{$supplier->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="" cols="30" rows="2" class="form-control"
                                            value="{{ old('description') }}" placeholder="Description">
                                            {{ $equipment->description }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <textarea name="remarks" id="" cols="30" rows="2" class="form-control"
                                            value="{{ old('remarks') }}" placeholder="Remarks">
                                            {{ $equipment->remarks }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('srequipment.index') }}" class="btn btn-default btn-sm">Cancel</a>

                    </div>
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
