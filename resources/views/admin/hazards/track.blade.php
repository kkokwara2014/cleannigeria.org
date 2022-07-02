@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <p>
            <a href="{{ route('hazardreports.index') }}" class="btn btn-success btn-sm">
                All Hazard Reports
            </a>
        </p>
        
        <div class="row">
            
            <div class="col-md-11">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div>
                                 <strong>Report #:</strong> {{$hreport->uniquenum}}
                                 </div>            
                                 <div>
                                 <strong>Unsafe Act:</strong> {{$hreport->unsafeact}}
                                 </div>            
                                 <div>
                                 <strong>Unsafe Condition:</strong> {{$hreport->unsafecondition}}
                                 </div>            
                                 <div>
                                 <strong>Near Miss:</strong> {{$hreport->nearmiss}}
                                 </div>            
                                 <div>
                                 <strong>Good Practice:</strong> {{$hreport->gp}}
                                 </div>            
                                 <div>
                                 <strong>Risk Category:</strong> {{$hreport->riskcategory}}
                                 </div>            
                                 <div>
                                 <strong>Description:</strong>
                                 <p style="text-align:justify">{{$hreport->description}}</p>
                                 </div>            
                                 <div>
                                 <strong>Immediate Corrective Action:</strong> 
                                 <p style="text-align:justify">{{$hreport->correctiveaction}}</p>
                                 </div>            
                                 <div>
                                 <strong>Further Action:</strong> 
                                 <p style="text-align:justify">{{$hreport->furtheraction}}</p>
                                 </div>            
                                 <div>
                                 <strong>Further Action:</strong> 
                                 <p style="text-align:justify">{{$hreport->furtheraction}}</p>
                                 </div>            
                                 <div>
                                 <strong>Occurance Date/Time:</strong> 
                                 <p style="text-align:justify">{{$hreport->dateofoccurence.' '.$hreport->timeofoccurence}}</p>
                                 </div>            
                                 <div>
                                 <strong>Reporting Date/Time:</strong> 
                                 <p style="text-align:justify">{{$hreport->dateofreporting.' '.$hreport->timeofreporting}}</p>
                                 </div>            
                                 <div>
                                 <strong>Location:</strong> 
                                 <p style="text-align:justify">{{$hreport->location->name}}</p>
                                 </div>
                                 <div>
                                 <strong>Status:</strong> 
                                    <p>
                                    @if ($hreport->isclosed==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Closed</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Open</span>

                                        @endif
                                    </p>
                                 </div>            
                                 <div>
                                 <strong>Observed By:</strong> 
                                 <p style="text-align:justify; font-weight:bolder">{{$hreport->user->firstname.' '.$hreport->user->lastname}}</p>
                                 </div>            

                            </div>
                            <div class="col-md-6">
                                    <div class="panel panel-default"> 
                                    <div class="panel-body"> 
                                <form action="{{route('hazardactiontracking.store')}}" method="POST">
                                    @csrf

                                    <input type="hidden" name="hazardreport_id" value="{{$hreport->id}}">

                                    <div class="form-group">
                                        <label>Proposed Closing Date <strong style="color: red">*</strong></label>
                                            <input name="proposedclosingdate" type="text" id="datepicker2" class="form-control" placeholder="Proposed Closing Date" required> 
                                    </div>
                                    <div class="form-group">
                                        <label>Remark <strong style="color: red">*</strong></label>
                                        <textarea name="remark" class="form-control" rows="3"
                                            placeholder="Remark" required maxlength="300">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Timeline </label>
                                        <textarea name="timeline" class="form-control" rows="3"
                                            placeholder="Timeline" maxlength="300">
                                        </textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    
                                </form>
                                    </div> 
                                    
                                    </div>

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
