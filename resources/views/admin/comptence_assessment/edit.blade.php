@extends('admin.layout.app')

@section('title')
Edit Competence Assessment
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-10">
                <p>
                    <a href="{{ route('competenceassessment.index') }}" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> All Competence Assessments</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('compassessment.update',$comptass->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Title <i style="color: red">*</i></label>
                                <select name="title" class="form-control" required>
                                    <option value="" selected="disabled">Select Title</option>
                                    <option value="Competence Assessment Phase I">Competence Assessment Phase I</option>
                                    <option value="Competence Assessment Phase II">Competence Assessment Phase II</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>Assessment Year <strong style="color:red;">*</strong></label>
                                <select name="assessmentyear" class="form-control" required>
                                    <option selected="disabled" value="">Select Assessment Year</option>
                                    @foreach ($assessmentyears as $appyear)
                                    <option value="{{$appyear}}" {{ $comptass->assessmentyear == $appyear ? 'selected' : '' }}>{{$appyear}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Starting <i style="color: red">*</i></label>
                                        <input type="text" id="datepicker" name="starting" value="{{ $comptass->starting }}" class="form-control" placeholder="Starting Date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ending <i style="color: red">*</i></label>
                                        <input type="text" id="datepicker1" name="ending" value="{{ $comptass->ending }}" class="form-control" placeholder="Ending Date" required>
                                    </div>
                                </div>
                            </div>                            

                            <a href="{{ route('competenceassessment.index') }}"  class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

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