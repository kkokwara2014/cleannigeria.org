@extends('admin.layout.app')

@section('title')
Add Competence Assessment
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
                        <form action="{{ route('competenceassessment.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Title <i style="color: red">*</i></label>
                                <select name="title" class="form-control" required>
                                    <option selected="disabled">Select Title</option>
                                    <option value="Competence Assessment Phase I">Competence Assessment Phase I</option>
                                    <option value="Competence Assessment Phase II">Competence Assessment Phase II</option>
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label>Assessment Year <strong style="color:red;">*</strong></label>
                                <select name="assessmentyear" class="form-control" required>
                                    <option selected="disabled" value="">Select Assessment Year</option>
                                    @foreach ($assessmentyears as $appyear)
                                    <option value="{{$appyear}}" {{ old('assessmentyear') == $appyear ? 'selected' : '' }}>{{$appyear}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Starting Date <i style="color: red">*</i></label>
                                        <input type="text" id="datepicker" name="starting" class="form-control" placeholder="Starting Date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ending Date <i style="color: red">*</i></label>
                                        <input type="text" id="datepicker1" name="ending" class="form-control" placeholder="Ending Date" required>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('competenceassessment.index') }}"  class="btn btn-danger btn-sm">Cancel</a>
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