@extends('admin.layout.app')

@section('title')
{{ucfirst($staff->firstname).' '.ucfirst($staff->lastname)}}
[{{ $staff->phone }}] Competence Assessment Details
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

                @include('admin.messages.success')

                @if($hsworkenv->isassessed==1 && $hsrisk->isassessed==1
                && $hsriskmgt->isassessed==1 && $fatraining->isassessed==1
                && $gastesting->isassessed==1 && $ophandover->isassessed==1
                && $forkliftop->isassessed==1 && $selfloader->isassessed==1
                && $powerdriven->isassessed==1 && $respequip->isassessed==1
                && $miscresp->isassessed==1 && $fateoil->isassessed==1
                && $impoilpollu->isassessed==1 && $survmodviz->isassessed==1
                && $offshoreresp->isassessed==1 && $dispers->isassessed==1
                && $shorelineresp->isassessed==1 && $inlandresp->isassessed==1
                && $incidmgt->isassessed==1)
                    <a target="_blank"
                        href="{{ route('print.approved.competenceassessment',[$comptassuser->competenceassessment_id,$comptassuser->user_id]) }}"
                        class="btn btn-primary btn-sm btnprnt" style="float: right"><span class="fa fa-print"></span>
                        Print Report</a>
                @endif

            </p>
            @if($hsworkenv->isassessed==1 && $hsrisk->isassessed==1
            && $hsriskmgt->isassessed==1 && $fatraining->isassessed==1
            && $gastesting->isassessed==1 && $ophandover->isassessed==1
            && $forkliftop->isassessed==1 && $selfloader->isassessed==1
            && $powerdriven->isassessed==1 && $respequip->isassessed==1
            && $miscresp->isassessed==1 && $fateoil->isassessed==1
            && $impoilpollu->isassessed==1 && $survmodviz->isassessed==1
            && $offshoreresp->isassessed==1 && $dispers->isassessed==1
            && $shorelineresp->isassessed==1 && $inlandresp->isassessed==1
            && $incidmgt->isassessed==1)
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-10">
                    <button class="btn btn-success btn-block">
                        <span class="fa fa-check-circle"></span>
                        This Individual Competence Assessment has been completely assessed and reviewed by the Assessor.
                    </button>

                </div>
                <div class="col-md-2">
                    @if (Auth::user()->hasAnyRole(['Admin'])||Auth::user()->hasAnyRole(['General Manager']))
                        @if ($hsworkenv->isapproved==1 && $hsrisk->isapproved==1
                        && $hsriskmgt->isapproved==1 && $fatraining->isapproved==1
                        && $gastesting->isapproved==1 && $ophandover->isapproved==1
                        && $forkliftop->isapproved==1 && $selfloader->isapproved==1
                        && $powerdriven->isapproved==1 && $respequip->isapproved==1
                        && $miscresp->isapproved==1 && $fateoil->isapproved==1
                        && $impoilpollu->isapproved==1 && $survmodviz->isapproved==1
                        && $offshoreresp->isapproved==1 && $dispers->isapproved==1
                        && $shorelineresp->isapproved==1 && $inlandresp->isapproved==1
                        && $incidmgt->isapproved==1)
                        {{--  <a href="#" data-toggle="modal" data-target="#modal-giveapproval-{{ $comptassuser->id }}"
                            class="btn btn-primary btn-block"><span class="fa fa-check"></span> Give Approval</a>  --}}
                        
                            <button class="btn btn-success btn-block"><span class="fa fa-thumbs-o-up"></span>
                                Approved
                            </button>
                        @else
                            <button class="btn btn-danger btn-block"><span class="fa fa-thumbs-o-down"></span>
                                Not Yet Approved
                            </button>
                        @endif
                    @endif
                </div>
                <!--Modal for Giving Approval-->
                <div class="modal fade" id="modal-giveapproval-{{ $comptassuser->id }}">
                    <div class="modal-dialog">

                        <form
                            action="{{ route('approve.assessed.comptass',[$comptassuser->competenceassessment_id,$comptassuser->user_id]) }}"
                            method="post" onsubmit="return confirm ('Give Approval?')">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"> Give Approval to
                                        {{ $staff->firstname.' '.$staff->lastname .'\'s'}} Competence Assessment
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="competenceassessmentuser_id"
                                        value="{{ $comptassuser->id }}">

                                    <div class="form-group">
                                        <label for="">Comment</label>
                                        <textarea name="comment" class="form-control" cols="30" rows="5" required
                                            placeholder="Give approval comment"></textarea>
                                    </div>
                                    

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->

                        </form>
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>

            @endif
            

                <p>
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">
                        Back</a>
                        <a href="{{ route('submitted.comptass') }}" class="btn btn-success btn-sm">
                            <span class="fa fa-eye"></span> Submitted Competence Assessment
                        </a>
                </p>

               
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        {{--  beginning of hsworkenv  --}}
                        @include('admin.comptence_assessment.partials.hsworkenv')
                        {{--  end of hsworkenv  --}}

                        {{--  begining of hsrisk  --}}
                        @include('admin.comptence_assessment.partials.hsrisk')

                        {{--  end of hsrisk  --}}

                        {{--  begining of hsriskmgt  --}}
                        @include('admin.comptence_assessment.partials.hsriskmgt')
                        
                        {{--  end of hsriskmgt  --}}
                        
                        {{--  begining of fatraining  --}}
                        
                        @include('admin.comptence_assessment.partials.fatraining')
                        {{--  end of fatraining  --}}
                        
                        {{--  begining of gas testing  --}}
                        @include('admin.comptence_assessment.partials.gastesting')
                        
                        {{--  end of gas testing  --}}
                        
                        {{--  begining of handover operations  --}}
                        
                        @include('admin.comptence_assessment.partials.handoveroperation')
                        {{--  end of handover operations  --}}
                        
                        {{--  begining of forklift operations  --}}
                        @include('admin.comptence_assessment.partials.forkliftoperation')
                        
                        {{--  end of forklift operations  --}}
                        
                        {{--  begining of selfloader operation  --}}
                        
                        @include('admin.comptence_assessment.partials.selfloaderoperation')
                        {{--  end of selfloader operation  --}}
                        
                        {{--  begining of power driven  --}}
                        @include('admin.comptence_assessment.partials.powerdriven')
                        
                        {{--  end of power driven  --}}
                        
                        
                        {{--  begining of response equipment  --}}
                        @include('admin.comptence_assessment.partials.responseequipment')
                        {{--  end of response equipment  --}}
                        
                        {{--  begining of misc response  --}}
                        @include('admin.comptence_assessment.partials.miscresponse')
                                
                        {{--  end of misc response  --}}
                        
                        
                        {{--  begining of fate of oil  --}}
                        @include('admin.comptence_assessment.partials.fateofoil')
                        
                        {{--  end of fate of oil  --}}
                        
                        {{--  begining of oil poullution  --}}
                        @include('admin.comptence_assessment.partials.impoilpoullution')
                        
                        {{--  end of oil poullution  --}}
                        
                        {{--  begining of surveillance  --}}
                        @include('admin.comptence_assessment.partials.surveillance')
                        
                        {{--  end of surveillance  --}}
                        
                        {{--  begining of offshore response  --}}
                        @include('admin.comptence_assessment.partials.offshoreresponse')
                        
                        {{--  end of offshore response  --}}
                        
                        {{--  begining of dispersant  --}}
                        @include('admin.comptence_assessment.partials.dispersant')
                        
                        {{--  end of dispersant  --}}
                        
                        {{--  begining of shoreline response  --}}
                        @include('admin.comptence_assessment.partials.shorelineresponse')
                        
                        {{--  end of shoreline response  --}}
                        
                        {{--  begining of inland response  --}}
                        @include('admin.comptence_assessment.partials.inlandresponse')
                        
                        {{--  end of inland response  --}}
                        
                        {{--  begining of incident mgt  --}}
                        @include('admin.comptence_assessment.partials.incidentmanagement')

                       {{--  end of incident mgt  --}}



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