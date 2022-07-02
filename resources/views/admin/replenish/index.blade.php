@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        {{-- <a href="{{ route('replenish.create') }}" class="btn btn-success btn-sm"> <span class="fa fa-refresh"></span> Replenish SR Equipment</a> --}}

        <br>
        {{-- <br> --}}
        <div class="row">
            <div class="col-md-7">

                @include('admin.messages.deleted')
                {{-- @include('admin.messages.success') --}}

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>SRE</th>
                                    <th>Replenished By</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($replenishes as $replenish)
                                <tr>
                                    <td>{{ $replenish->srequipment->name .' with ref #'.$replenish->srequipment->refnumb}}</td>

                                    <td>{{$replenish->user->firstname.' '.$replenish->user->lastname}}</td>
                                    <td>{{$replenish->qty}}</td>
                                    <td>
                                        @if ($replenish->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Unapproved</span>

                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)

                                                @if ($replenish->isapproved==0)
                                                <form id="approve-{{$replenish->id}}" style="display: none"
                                                    action="{{ route('replenish.approve',$replenish->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$replenish->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @endif

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('replenish.edit',$replenish->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$replenish->id}}" style="display: none"
                                                    action="{{ route('replenish.destroy',$replenish->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$replenish->id}}').submit();
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
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SRE</th>
                                    <th>Replenished By</th>
                                    <th>Qty</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-5">
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('replenish.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">SR Equipment *</label>
                                <select name="srequipment_id" class="form-control" autofocus>
                                    <option selected="disabled">Select Equipment</option>
                                    @foreach ($srequipments as $srequipment)
                                    <option value="{{$srequipment->id}}">{{'#'.$srequipment->refnumb.' - '.$srequipment->name.' in '.$srequipment->store->location->name.' Qty = '.$srequipment->qty}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="">Quantity *</label>
                                <input type="text" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    name="qty" value="{{ old('qty') }}" placeholder="Quantity to be replenished" autofocus
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

                            {{-- <a href="{{ route('replenish.index') }}" class="btn btn-default btn-sm">Cancel</a> --}}
                            <input type="reset" class="btn btn-default btn-sm" value="Cancel">
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
