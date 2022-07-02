@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('mobilizationrequest.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">


<div class="row">
    <div class="col-md-6">
        <div>
            <label for="">Reference number : </label>
             {{ $mobreq->refnumb }}
        </div>
        <div>
            <label for="">Member Company : </label>
            {{ $mobreq->membcomp }}
        </div>
        <div>
            <label for="">Notifier : </label>
            {{ $mobreq->notifier }}
        </div>
        <div>
            <label for="">Designation : </label>
            {{ $mobreq->designation!=''?$mobreq->designation:'N/A' }}
        </div>
        <div>
            <label for="">Direct Phone : </label>
            {{ $mobreq->directphone!=''?$mobreq->directphone:'N/A' }}
        </div>
        <div>
            <label for="">Mobile Phone : </label>
            {{ $mobreq->mobilephone }}
        </div>
        <div>
            <label for="">Email : </label>
            {{ $mobreq->email }}
        </div>
        <div>
            <label for="">Centre Number : </label>
            {{ $mobreq->centrenumb!=''?$mobreq->centrenumb:'N/A' }}
        </div>

        <hr>

        <div>
            <label for="">Activation Date : </label>
            {{ $mobreq->dateofact }}
        </div>
        <div>
            <label for="">Activation Time : </label>
            {{ $mobreq->timeofact }}
        </div>
        <div>
            <label for="">Date of Spill : </label>
            {{ $mobreq->spilldate }}
        </div>
        <div>
            <label for="">Spill Time : </label>
            {{ $mobreq->spilltime!=''?$mobreq->spilltime:'N/A' }}
        </div>
        <div>
            <label for="">Spill Source : </label>
            {{ $mobreq->spillsource!=''?$mobreq->spillsource:'N/A' }}
        </div>
        <div>
            <label for="">Spill Cause : </label>
            {{ $mobreq->spillcause!=''?$mobreq->spillcause:'N/A' }}
        </div>

        <hr>
        <br>

    </div>
    <div class="col-md-6">
        <div>
            <label for="">Location : </label>
            {{ $mobreq->location!=''?$mobreq->location:'N/A' }}
        </div>
        <div>
            <label for="">Town : </label>
            {{ $mobreq->town!=''?$mobreq->town:'N/A' }}
        </div>
        <div>
            <label for="">Spill Status : </label>
            {{ $mobreq->spillstatus }}
        </div>
        <div>
            <label for="">Production Type :</label>
            {{ $mobreq->productiontype!=''?$mobreq->productiontype:'N/A' }}
        </div>
        <div>
            <label for="">Facility : </label>
            {{ $mobreq->facility!=''?$mobreq->facility:'N/A' }}
        </div>
        <div>
            <label for="">Environment Type : </label>
            {{ $mobreq->environmenttype }}
        </div>
        <div>
            <label for="">Resources at risk : </label>
            {{ $mobreq->res_at_risk!=''?$mobreq->res_at_risk:'N/A' }}
        </div>
        <div>
            <label for="">Number of Personnel : </label>
            {{ $mobreq->numofpersonnel }}
        </div>

        <hr>

        <div>
            <label for="">COVID-19 Protection Protocol : </label>
            {{ $mobreq->safetyinfo1}}
        </div>
        <div>
            <label for="">Crew change requirements : </label>
            {{ $mobreq->safetyinfo2 }}
        </div>
        <div>
            <label for="">Safety Info. 3 : </label>
            {{ $mobreq->safetyinfo3!=''?$mobreq->safetyinfo3:'N/A' }}
        </div>
        <div>
            <label for="">Safety Info. 4 : </label>
            {{ $mobreq->safetyinfo4!=''?$mobreq->safetyinfo4:'N/A' }}
        </div>
        <div>
            <label for="">Added Info. : </label>
            {{ $mobreq->addedinfo!=''?$mobreq->addedinfo:'N/A' }}
        </div>
        <div>
            <label for="">Provision(s) : </label>
            {{ $mobreq->provision }}
        </div>
        <div>
            <label for="">Welfare Provision(s). : </label>
            {{ $mobreq->welfareprov!=''?$mobreq->welfareprov:'N/A' }}
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
