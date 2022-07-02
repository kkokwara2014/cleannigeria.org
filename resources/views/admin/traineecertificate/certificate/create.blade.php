@extends('admin.layout.app')

@section('title')
Add Certificate
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('certificates.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Certificates
            </a>
        </p>

        <div class="row">
            <div class="col-md-11">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('certificates.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trainee <span style="color: red">*</span></label>
                                        <select name="trainee_id" class="form-control" required>
                                            <option selected="disabled" value="">Select Trainee</option>
                                            @foreach ($trainees as $trainee)
                                            <option value="{{ $trainee->id }}">{{ $trainee->firstname.' '.strtoupper($trainee->lastname) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Training <span style="color: red">*</span></label>
                                        <select name="training_id" class="form-control" required>
                                            <option selected="disabled" value="">Select Training</option>
                                            @foreach ($trainings as $training)
                                            <option value="{{ $training->id }}">{{ $training->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Certificate Number</label>
                                        <input type="text" class="form-control{{ $errors->has('certnumber') ? ' is-invalid' : '' }}"
                                            name="certnumber" value="{{ old('certnumber') }}" placeholder="Certificate Number" required maxlength="13">
        
                                        @if ($errors->has('certnumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('certnumber') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unique Code <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('uniquecode') ? ' is-invalid' : '' }}"
                                            name="uniquecode" value="{{ $generatedcode }}" readonly style="background-color: green; color: honeydew; font-size: 25px;">
                                    </div>
                                    <div class="form-group">
                                        <label>Issued on <span style="color: red">*</span></label>
                                        <input id="issuedon" type="date" class="form-control{{ $errors->has('issuedon') ? ' is-invalid' : '' }}"
                                            name="issuedon" value="{{ old('issuedon') }}" placeholder="Date Issued" required>
        
                                        @if ($errors->has('issuedon'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('issuedon') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Validity Period</label>
                                        <input type="text" class="form-control{{ $errors->has('validityperiod') ? ' is-invalid' : '' }}"
                                            name="validityperiod" id="validityperiod" readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Upload Certificate <span style="color: red">* (PDF only)</span></label>
                                        <input type="file" name="certfilename" required>
                                    </div> --}}
                                </div>

                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <a href="{{ route('certificates.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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