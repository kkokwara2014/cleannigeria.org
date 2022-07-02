@extends('admin.layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
@include('admin.layout.statboard')
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">

   @include('admin.messages.success')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <h3>{{$greeting .', '.ucfirst($user->firstname).' '.ucfirst($user->lastname).'!'}}</h3>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h3>Profile Image</h3><br>
                        <img src="{{url('user_images',$user->userimage)}}" alt=""
                            class="img-responsive img-circle" width="200" height="180" style="border-radius: 50%;">

                            <br><br>
                    </div>
                    <div class="col-md-3"></div>
                </div>

            </div>
          </div>
    </div>
    <div class="col-md-8">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.user.profilestatus')
            </div>
          </div>
    </div>
</div>


@if ($user->staffcategory_id==1 || $user->staffcategory_id==2)
{{-- details on submited competence assessments --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <h3>Competence Assessment Statistics</h3>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Submissions by You</h4>
                        <a href="{{ route('comptassbyyou') }}" title="Click to view details">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    {{ Str::plural('Competence Assessment',$mysubmittedcomptassments)  }} 
                                   @if ($mysubmittedcomptassments>0)
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: green; color:seashell">{{ $mysubmittedcomptassments }}</span>
                                    @else
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: crimson; color:seashell">{{ $mysubmittedcomptassments }}</span>
                                   @endif
                                </div>
                            </div>
                        </a>
                       
                    </div>
                    <div class="col-md-6">
                        <h4>Submissions made to You for Assessment</h4>

                        <a href="{{ route('comptassforyou') }}" title="Click to view details">
                            <div class="panel panel-default">
                                <div class="panel-body"> 
                                    {{ Str::plural('Competence Assessment',$submittedcomptassforme)  }} 
                                   
                                    @if ($submittedcomptassforme>0)
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: green; color:seashell">{{ $submittedcomptassforme }}</span>
                                    @else
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: crimson; color:seashell">{{ $submittedcomptassforme }}</span>
                                   @endif
                                </div>
                            </div>
                        </a>                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @if (auth()->user()->hasAnyRole(['East Regional Superintendent'])||auth()->user()->hasAnyRole(['West Regional Superintendent'])||auth()->user()->hasAnyRole(['East Regional Supervisor'])||auth()->user()->hasAnyRole(['West Regional Supervisor'])||auth()->user()->hasAnyRole(['General Manager'])||auth()->user()->hasAnyRole(['Admin']))
                        <h4>Submissions to You for Reassessment (Review)</h4>
                        <a href="{{ route('senttosuperior') }}" title="Click to view details">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    {{ Str::plural('Competence Assessment',$submittedcomptassforsuperior)  }} 
                                   @if ($submittedcomptassforsuperior>0)
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: green; color:seashell">{{ $submittedcomptassforsuperior }}</span>
                                    @else
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: crimson; color:seashell">{{ $submittedcomptassforsuperior }}</span>
                                   @endif
                                </div>
                            </div>
                        </a>
                        @endif
                       
                    </div>
                    <div class="col-md-6">
                       @if (auth()->user()->hasAnyRole(['General Manager'])||auth()->user()->hasAnyRole(['Admin']))
                        <h4>Submissions to You for Final Assessment</h4>
                        <a href="{{ route('senttogm') }}" title="Click to view details">
                            <div class="panel panel-default">
                                <div class="panel-body"> 
                                    {{ Str::plural('Competence Assessment',$submittedcomptassforgm)  }} 
                                    
                                    @if ($submittedcomptassforgm>0)
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: green; color:seashell">{{ $submittedcomptassforgm }}</span>
                                    @else
                                        <span class="badge badge-pill badge-primary" style="float: right; background-color: crimson; color:seashell">{{ $submittedcomptassforgm }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>                     
                           
                       @endif
                    </div>
                </div>
                
            </div>
          </div>
    </div>
</div>
@endif
   


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
