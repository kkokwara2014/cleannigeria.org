@extends('admin.layout.app')

@section('title')

@if ($staff->staffcategory_id==1 || $staff->staffcategory_id==2)
    Show Staff Details
@else
    Show Partner Details           
@endif
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('staff.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="{{url('user_images',$staff->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250" style="border-radius: 50%">

                            </div>


                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-8">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>
                                   @if ($staff->staffcategory_id==1 || $staff->staffcategory_id==2)
                                        Staff Details
                                   @else
                                        Partner Details           
                                   @endif
                                </h3>
                                <hr>
                                 <h2><strong>{{$staff->firstname.' '.$staff->lastname}}</strong></h2>
                                    {{-- <small>[{{ $staff->role->name }}]</small> --}}
                                
                               

                                <div><span class="fa fa-envelope"></span> {{$staff->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$staff->phone}}</div>
                                <div><span class="fa fa-th"></span> {{$staff->staffcategory->name}}</div>
                                <div><span class="fa fa-map-marker"></span> {{$staff->location->name}}</div>
                                <div><span class="fa fa-clock-o"></span> {{$staff->created_at->diffForHumans().' on '.date('D d F, Y h:ia',strtotime($staff->created_at))}} [Date Created]</div>
                                <div>
                                    Status :
                                    @if ($staff->isactive==1)
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: seagreen; color:seashell"> Active</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: sienna; color:seashell"> Inactive</span>

                                    @endif
                                </div>                

                                
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>

       @if ($staff->staffcategory_id==1 || $staff->staffcategory_id==2)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Competence Assessments submitted by <strong>{{ $staff->firstname.' '.$staff->lastname }}</strong></h3>
                                <hr>

                                @forelse ($comptassusers as $comptassuser)

                                <div class="panel panel-default">
                                    <div class="panel-body"> 
                                            <a href="{{ route('comptass.show',[$comptassuser->competenceassessment_id,$staff_id]) }}" title="Click to see details">
                                                {{ $comptassuser->competenceassessment->title.' '.$comptassuser->competenceassessment->assessmentyear }} 
                                                &nbsp;to be assessed by &nbsp;
                                                @foreach($senttosuperiors as $assessor)
                                                    @if($comptassuser->sentto_id==$assessor->id)
                                                        {{$assessor->firstname.' '.$assessor->lastname}}
                                                    @endif
                                                @endforeach
                                            </a>
                                            
                                           @if ($comptassuser->isassessed==1)
                                            <span style="float: right; background-color:green; color:whitesmoke;" class="badge badge-success badge-pill">Assessed</span>   
                                            @else
                                            <span style="float: right; background-color:red; color:whitesmoke;" class="badge badge-success badge-pill">Not Assessed</span>   
                                               
                                           @endif
                                    </div>
                                </div>
                                @empty
                                <span style="background-color: red; color: seashell">
                                    Staff has not filled any Competence Assessment.
                                </span>
                                @endforelse

                                
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
      @endif

      {{-- for partner maintenance request statistics --}}
       @if ($staff->staffcategory_id==3)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Maintenance request by <strong>{{ $staff->firstname.' '.$staff->lastname }}</strong></h3>
                                <hr>

                                @forelse ($comptassusers as $comptassuser)

                                <div class="panel panel-default">
                                    <div class="panel-body"> 
                                            <a href="{{ route('comptass.show',[$comptassuser->competenceassessment_id,$staff_id]) }}" title="Click to see details">
                                                {{ $comptassuser->competenceassessment->title.' '.$comptassuser->competenceassessment->assessmentyear }} 
                                            </a>
                                                                                       
                                    </div>
                                </div>
                                @empty
                                <span style="background-color: red; color: seashell">
                                    Partner has not made any Maintenance request.
                                </span>
                                @endforelse

                                
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
