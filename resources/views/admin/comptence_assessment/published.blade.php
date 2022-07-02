@extends('admin.layout.app')

@section('title')
Published Competence Assessments
@endsection

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
                    {{-- @if(Auth::user()->role_id<=7) --}}
                    <a href="{{ route('competenceassessment.index') }}" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> All Competence Assessments</a>
                    {{-- @endif --}}
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        @foreach ($comptass as $ctass)
                            <h4>{{ $ctass->title.' '.$ctass->assessmentyear}} 
                                                              
                               @if (date('m/d/Y')>$ctass->ending)
                                    <span style="color:red">Closed on {{ date('d M, Y',strtotime($ctass->ending)) }}!</span>
                               @else
                                    <small><a href="{{ route('fillcomptassform',$ctass->slug) }}">Fill Competence Assessment Form</a> &nbsp;&nbsp;[Open from {{ date('d M, Y',strtotime($ctass->starting)) .' to '. date('d M, Y',strtotime($ctass->ending)) }}] </small>
                               @endif
                            </h4>    
                        @endforeach
                        
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