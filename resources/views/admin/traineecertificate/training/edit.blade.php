@extends('admin.layout.app')

@section('title')
    Edit Training
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('trainings.index') }}" class="btn btn-success btn-sm">
           <span class="fa fa-eye"></span> All Trainings
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-10">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('trainings.update',$training->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Name <span style="color: red">*</span></label>
                                <input type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ $training->name }}" placeholder="Training Name" autofocus
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
                                    name="startdate" value="{{ $training->startdate }}" placeholder="Start Date" required>

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
                                    name="enddate" value="{{ $training->enddate }}" placeholder="End Date" required>

                                @if ($errors->has('enddate'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('enddate') }}</span>
                                </span>
                                @endif
                            </div>
                            

                            <a href="{{ route('trainings.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

                        </form>
                    </div>
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
