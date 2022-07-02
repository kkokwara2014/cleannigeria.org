@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('transfer.index') }}" class="btn btn-primary btn-sm">
            <span class="fa fa-exchange"></span> All Tranfers
        </a>
        <br>
        <br>

        <div class="row">
            <div class="col-md-7">
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('transfer.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">SR Equipment</label>
                                <select name="srequipment_id" class="form-control" autofocus>
                                    <option selected="disabled">Select Equipment</option>
                                    @foreach ($srequipments as $srequipment)
                                    <option value="{{$srequipment->id}}">{{'#'.$srequipment->refnumb.' - '.$srequipment->name.' in '.$srequipment->store->location->name.' Qty = '.$srequipment->qty}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group has-feedback{{ $errors->has('to_location_id')?'has-error':'' }}">
                                <label for="">To Location *</label>
                                <select name="to_location_id" class="form-control" autofocus>
                                    <option selected="disabled">Select Location</option>
                                    @foreach ($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}
                                    </option>
                                    @endforeach

                                </select>
                                @if ($errors->has('to_location_id'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('to_location_id','Select Location') }}</span>
                                </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="">Quantity *</label>
                                <input type="text" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    name="qty" value="{{ old('qty') }}" placeholder="Quantity" autofocus
                                    pattern="[0-9]+" maxlength="4">

                                @if ($errors->has('qty'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('qty','Enter Quantity') }}</span>
                                </span>
                                @endif

                                @if (Session::has('msg'))
                                    <span style="color: red">{{ Session::get('msg') }}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="">Reason for Transfer *</label>
                                <textarea name="reason" id="" cols="30" rows="3"
                                    class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}"
                                    value="{{ old('reason') }}" placeholder="Transfer reason">

                        </textarea>

                                @if ($errors->has('reason'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('reason','Enter Transfer reason') }}</span>
                                </span>
                                @endif
                            </div>

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <a href="{{ route('transfer.index') }}" class="btn btn-default btn-sm">Cancel</a>

                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
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
