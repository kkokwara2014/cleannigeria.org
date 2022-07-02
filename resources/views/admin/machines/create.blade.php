@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <a class="btn btn-success btn-sm" href="{{ route('machines.index') }}"><span class="fa fa-eye"></span> All Machines</a>
        <br><br>

        <div class="row">
            <div class="col-md-11">


                @include('admin.messages.success')
                @include('admin.messages.deleted')
                @include('admin.messages.refusal')


                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('machines.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <strong style="color: red">*</strong></label>
                                        <input type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" placeholder="Machine Name" required>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('name') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location <strong style="color: red">*</strong></label>
                                        <select name="location_id" class="form-control" required>
                                            <option selected="disabled">Select Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->id}}">
                                                {{$location->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status <strong style="color: red">*</strong></label>
                                        <select name="status" class="form-control" required>
                                            <option selected="disabled">Select Status</option>
                                            <option value="Corrective">Corrective</option>
                                            <option value="Preventive">Preventive</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Before Usage Information <strong style="color: red">*</strong></label>
                                        <textarea name="beforeuse" class="form-control" cols="30" rows="3"
                                            value="{{ old('beforeuse') }}" placeholder="Before Usage Information"
                                            required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">After Usage Information <strong style="color: red">*</strong></label>
                                        <textarea name="afteruse" class="form-control" cols="30" rows="4"
                                            value="{{ old('afteruse') }}" placeholder="After Usage Information"
                                            required></textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h3>Maintenance Schedule</h3>
                                    <div class="form-group">
                                        <label for="">Monthly <small style="color: red">[Monthly or every 50hrs]</small></label>
                                        <textarea name="monthly" cols="30" rows="2" class="form-control"
                                            value="{{ old('monthly') }}" placeholder="Monthly or every 50hrs"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quarterly <small style="color: red">[Every 3 months or every 50hrs]</small></label>
                                        <textarea name="quarterly" cols="30" rows="2" class="form-control"
                                            value="{{ old('quarterly') }}" placeholder="Every 3 months or every 50hrs"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Semiannually <small style="color: red">[Every 6 months or every 400hrs]</small></label>
                                        <textarea name="semiannually" cols="30" rows="2" class="form-control"
                                            value="{{ old('semiannually') }}" placeholder="Every 6 months or every 400hrs"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Annually <small style="color: red">[Every year or every 1000hrs]</small></label>
                                        <textarea name="annually" cols="30" rows="2" class="form-control"
                                            value="{{ old('annually') }}" placeholder="Every year or every 1000hrs"></textarea>
                                    </div>
                                </div>

                            </div>
                                                        
                            <a href="{{ route('machines.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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
