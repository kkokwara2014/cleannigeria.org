@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="{{url('user_images',$employee->user->userimage)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250" style="border-radius: 50%">

                                <p>
                                    <h2>{{$employee->user->firstname.' '.$employee->user->lastname}}</h2>
                                    
                                </p>
                                

                            </div>


                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-7">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                               <h3>Personal Information</h3>
                               <div>
                                  <h3> {{ $employee->title.' '.$employee->user->firstname.' '.$employee->user->lastname }}</h3>
                               </div>
                               
                                <div><span class="fa fa-envelope"></span> {{$employee->user->email}} </div>
                                <div><span class="fa fa-phone"></span> {{$employee->user->phone}}</div>
                                
                                <div><span class="fa fa-map-marker"></span>
                                        {{$employee->address}}{{ $employee->city!=''?', '.$employee->city.'.':'' }}
                                </div>
                                <div>
                                    LGA/State: {{ $employee->lga->name.', '.$employee->state->name.' State.' }}
                                </div>
                                <div>
                                    Date of Birth: {{ $employee->dob }}
                                </div>
                                <div>
                                    @if ($employee->maritalstatus=='Single')
                                        Marital Status: {{ $employee->maritalstatus }}
                                        
                                    @else
                                    Marital Status: {{ $employee->maritalstatus }}
                                    <div>
                                        Spouse Name: {{ $employee->spousename }}
                                    </div>
                                    <div>
                                        Spouse Employer: {{ $employee->spouseemployer }}
                                    </div>
                                    <div>
                                        Spouse Phone: {{ $employee->spousephone }}
                                    </div>
                                       
                                    @endif
                                </div>
                                <hr>
                                <h3>Job Information</h3>
                                <div>
                                    Qualification: {{ $employee->qualification }}
                                </div>
                                <div>
                                    Profession: {{ $employee->profession }}
                                </div>
                                <div>
                                    Job Title: {{ $employee->jobtitle }}
                                </div>
                                <div>
                                    Supervisor: {{ $employee->supervisor }}
                                </div>
                                <div>
                                    Location: {{ $employee->location->name }}
                                </div>
                                <div>
                                    Date of Employment: {{ date('d M, Y',strtotime($employee->dateofemployment)) }}
                                </div>
                                @if ($employee->contractenddate!='')
                                <div>
                                    Contract End Date: {{ date('d M, Y',strtotime($employee->contractenddate)) }}
                                </div>
                                @endif
                                <hr>
                                <h3>Emergency Contact Information</h3>
                                <div>
                                    Next of Kin: {{ $employee->nextofkin }}
                                </div>
                                <div>
                                    Next of Kin Phone: {{ $employee->nokphone }}
                                </div>
                                <div>
                                    Relationship: {{ $employee->nokrelationship }}
                                </div>
                                <div>
                                    Next of Kin Address: {{ $employee->nokaddress }}
                                </div>
                                <hr>
                                
                            </div>
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
