@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('replenish.index') }}" class="btn btn-success btn-sm">
           <span class="fa fa-eye"></span> All Replenishments
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-5">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('replenish.update',$replenishes->id) }}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="">SR Equipment</label>
                                <select name="srequipment_id" class="form-control" autofocus>
                                    <option selected="disabled">Select Equipment</option>
                                    @foreach ($srequipments as $srequipment)
                                    <option value="{{$srequipment->id}}" {{ $srequipment->id== $replenishes->srequipment->id?'selected':'' }}>{{'#'.$srequipment->refnumb.' - '.$srequipment->name.' in '.$srequipment->store->location->name.' Qty = '.$srequipment->qty}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Quantity *</label>
                                <input type="text" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    name="qty" value="{{ $replenishes->qty }}" placeholder="Quantity to be replenished" autofocus
                                    pattern="[0-9]+" maxlength="4">

                                @if ($errors->has('qty'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('qty','Enter Quantity to be replenished') }}</span>
                                </span>
                                @endif

                                @if (Session::has('msg'))
                                    <span style="color: red">{{ Session::get('msg') }}</span>
                                @endif

                            </div>

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('replenish.index') }}" class="btn btn-default btn-sm">Cancel</a>

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
