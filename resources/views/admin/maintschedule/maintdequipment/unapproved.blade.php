@extends('admin.layout.app')

@section('title')
    Unapproved Maintained Equipment
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
                    <a href="{{ route('select.maintoption') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus-circle"></span> Schedule Equipment</a>
                    {{--  <a href="{{ route('maintdequip.unapproved') }}" class="btn btn-warning btn-sm"><span class="fa fa-question-circle-o"></span> Unapproved Maintained Equipment</a>  --}}
                    {{--  <a href="{{ route('maintdequip.approved') }}" class="btn btn-success btn-sm"><span class="fa fa-check-circle-o"></span> Approved Maintained Equipment</a>  --}}
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')
    
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            {{ $maintdequipments->links() }}
                            @foreach ($maintdequipments as $maintequip)
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                       
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                href="#{{ $maintequip->id}}"> Maintenance Work Order of
                                                {{ date('d M, Y',strtotime($maintequip->created_at)) }} 

                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                               
                                                {{ $maintequip->created_at->diffForHumans() }}
                                                
                                                @  {{ date('H:i:s',strtotime($maintequip->created_at)) }}
                                            </a>

                                            
                                            &nbsp;
                                            &nbsp;
                                            @if ($maintequip->isapproved==1)
                                            <span class="badge badge-success badge-pill"
                                                style="background-color: green; color:seashell" style="float: right"> Approved</span>
                                            @else
                                            <span class="badge badge-danger badge-pill"
                                                style="background-color: crimson; color:seashell" style="float: right"> Not Approved</span>
                                            @endif
                                        </h4>
                                        
                                    </div>
                                    <div id="{{ $maintequip->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div>Maint. Start Date: {{ $maintequip->maintstartdate }}</div>
                                            <div>Maint. End Date: {{ $maintequip->maintenddate }}</div>
                                            <div style="text-align: justify">Activity Performed: {{ $maintequip->activitydone }}</div>
                                            <div>Done by: <strong>{{ $maintequip->user->firstname.' '. $maintequip->user->lastname.' ['.$maintequip->user->phone.']'}}</strong></div>
                                            <div>Uploaded File(s) : 
                                                <a href="{{ route('download.maintreport',$maintequip->maintreportfile) }}" download="{{ $maintequip->maintreportfile }}"><span class="fa fa-file-text"></span> <span class="fa fa-download" style="color: green"></span></a>
                                            </div>
                                            <div>
                                                <h4>More files</h4>
                                                <div class="row">
                                                    @foreach ($morefiles->chunk(4) as $chunk)
                                                    @foreach ($chunk as $morefile)

                                                    <div class="col-md-3">
                                                        <a href="{{ route('download.maintreport',$morefile->maintreportfile) }}" download="{{ $morefile->maintreportfile }}"><span class="fa fa-file-text"></span> <span class="fa fa-download" style="color: green"></span></a>
                                                    </div>
                                                    @endforeach
                                                    @endforeach
                                                </div>
                                
                                            </div>                                                
                                           
                                            @if ($maintequip->isapproved==1)
                                            <hr>
                                            <div>Approved by : <strong>{{ $maintequip->approvedby }}</strong></div>
                                            <div>Phone : {{ $maintequip->approverphone }}</div>
                                            <div>Approved on : {{ $maintequip->approvedon }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                                                                                       
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
