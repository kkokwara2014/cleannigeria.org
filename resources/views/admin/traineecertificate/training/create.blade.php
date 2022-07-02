@extends('admin.layout.app')

@section('title')
Create Training
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('trainings.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Trainings
            </a>
        </p>

        <div class="row">
            <div class="col-md-8">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('trainings.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Name <span style="color: red">*</span></label>
                                <input type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" placeholder="Training Name" autofocus
                                    required>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('name') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Start Date <span style="color: red">*</span></label>
                                <input type="date"
                                    class="form-control{{ $errors->has('startdate') ? ' is-invalid' : '' }}"
                                    name="startdate" value="{{ old('startdate') }}" placeholder="Start Date" required>

                                @if ($errors->has('startdate'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('startdate') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>End Date <span style="color: red">*</span></label>
                                <input type="date"
                                    class="form-control{{ $errors->has('enddate') ? ' is-invalid' : '' }}"
                                    name="enddate" value="{{ old('enddate') }}" placeholder="End Date" required>

                                @if ($errors->has('enddate'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('enddate') }}</span>
                                </span>
                                @endif
                            </div>
                            

                            <a href="{{ route('trainings.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>

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