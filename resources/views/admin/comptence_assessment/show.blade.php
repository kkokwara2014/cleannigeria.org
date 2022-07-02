@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">
                <p>
                    <a href="{{ route('submitted.comptass') }}" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> Submitted Competence Assessments</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="row">
                    <div class="col-md-5">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h3>Competence Assessment Report</h3>
        
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-md-7">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h3>Submitted Competence Assessment</h3>
        
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
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