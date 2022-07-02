@extends('admin.layout.app')

@section('title')
Make Final Assessment on {{ucfirst($staff->firstname).' '.ucfirst($staff->lastname)}}
[{{ $staff->phone }}] Competence Assessment
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
                @include('admin.messages.deleted')

                @if ($incidmgt->isapproved==1)
                    <p class="btn btn-success btn-sm">
                        Approval has been given successfully by <strong>{{ $incidmgt->nameofgm }}</strong>
                    </p>
                    <p></p>
                @endif

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <h3>{{ $hsworkenv->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $hsworkenv->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($hsworkenv->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($hsworkenv->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $hsworkenv->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $hsworkenv->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $hsworkenv->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $hsworkenv->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($hsworkenv->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsworkenv->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($hsworkenv->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsworkenv->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsworkenv->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $hsrisk->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $hsrisk->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($hsrisk->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsrisk->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($hsrisk->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsrisk->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsrisk->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $hsrisk->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $hsrisk->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $hsrisk->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $hsrisk->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($hsrisk->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsrisk->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($hsrisk->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsrisk->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsrisk->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $hsriskmgt->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $hsriskmgt->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($hsriskmgt->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($hsriskmgt->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $hsriskmgt->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $hsriskmgt->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $hsriskmgt->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $hsriskmgt->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($hsriskmgt->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsriskmgt->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($hsriskmgt->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsriskmgt->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $hsriskmgt->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $fatraining->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $fatraining->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($fatraining->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fatraining->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($fatraining->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fatraining->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fatraining->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $fatraining->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $fatraining->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $fatraining->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $fatraining->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($fatraining->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fatraining->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($fatraining->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fatraining->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fatraining->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $gastesting->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $gastesting->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($gastesting->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $gastesting->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($gastesting->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $gastesting->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $gastesting->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $gastesting->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $gastesting->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $gastesting->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $gastesting->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($gastesting->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $gastesting->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($gastesting->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $gastesting->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $gastesting->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $ophandover->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $ophandover->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($ophandover->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $ophandover->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($ophandover->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $ophandover->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $ophandover->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $ophandover->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $ophandover->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $ophandover->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $ophandover->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($ophandover->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $ophandover->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($ophandover->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $ophandover->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $ophandover->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $forkliftop->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $forkliftop->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($forkliftop->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $forkliftop->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($forkliftop->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $forkliftop->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $forkliftop->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $forkliftop->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $forkliftop->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $forkliftop->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $forkliftop->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($forkliftop->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $forkliftop->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($forkliftop->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $forkliftop->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $forkliftop->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $respequip->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $respequip->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($respequip->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $respequip->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($respequip->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $respequip->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $respequip->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $respequip->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $respequip->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $respequip->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $respequip->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($respequip->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $respequip->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($respequip->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $respequip->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $respequip->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $miscresp->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $miscresp->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($miscresp->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $miscresp->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($miscresp->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $miscresp->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $miscresp->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $miscresp->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $miscresp->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $miscresp->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $miscresp->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($miscresp->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $miscresp->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($miscresp->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $miscresp->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $miscresp->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $selfloader->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $selfloader->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($selfloader->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $selfloader->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($selfloader->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $selfloader->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $selfloader->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $selfloader->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $selfloader->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $selfloader->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $selfloader->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($selfloader->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $selfloader->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($selfloader->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $selfloader->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $selfloader->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $powerdriven->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $powerdriven->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($powerdriven->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $powerdriven->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($powerdriven->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $powerdriven->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $powerdriven->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $powerdriven->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $powerdriven->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $powerdriven->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $powerdriven->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($powerdriven->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $powerdriven->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($powerdriven->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $powerdriven->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $powerdriven->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $fateoil->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $fateoil->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($fateoil->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fateoil->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($fateoil->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fateoil->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $fateoil->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $fateoil->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $fateoil->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $fateoil->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $fateoil->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($fateoil->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fateoil->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($fateoil->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fateoil->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $fateoil->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $impoilpollu->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $impoilpollu->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($impoilpollu->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $impoilpollu->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($impoilpollu->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $impoilpollu->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $impoilpollu->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $impoilpollu->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $impoilpollu->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $impoilpollu->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $impoilpollu->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($impoilpollu->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $impoilpollu->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($impoilpollu->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $impoilpollu->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $impoilpollu->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $survmodviz->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $survmodviz->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($survmodviz->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $survmodviz->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($survmodviz->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $survmodviz->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $survmodviz->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $survmodviz->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $survmodviz->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $survmodviz->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $survmodviz->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($survmodviz->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $survmodviz->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($survmodviz->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $survmodviz->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $survmodviz->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $offshoreresp->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $offshoreresp->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($offshoreresp->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $offshoreresp->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($offshoreresp->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $offshoreresp->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $offshoreresp->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $offshoreresp->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $offshoreresp->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $offshoreresp->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $offshoreresp->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($offshoreresp->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $offshoreresp->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($offshoreresp->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $offshoreresp->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $offshoreresp->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $dispers->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $dispers->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($dispers->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $dispers->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($dispers->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $dispers->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $dispers->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $dispers->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $dispers->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $dispers->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $dispers->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($dispers->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $dispers->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($dispers->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $dispers->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $dispers->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $shorelineresp->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $shorelineresp->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($shorelineresp->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $shorelineresp->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($shorelineresp->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $shorelineresp->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $shorelineresp->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $shorelineresp->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $shorelineresp->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $shorelineresp->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $shorelineresp->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($shorelineresp->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $shorelineresp->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($shorelineresp->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $shorelineresp->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $shorelineresp->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>


                        <h3>{{ $inlandresp->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $inlandresp->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($inlandresp->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $inlandresp->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($inlandresp->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $inlandresp->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $inlandresp->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $inlandresp->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $inlandresp->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $inlandresp->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $inlandresp->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($inlandresp->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $inlandresp->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($inlandresp->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $inlandresp->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $inlandresp->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr>

                        <h3>{{ $incidmgt->caption }}</h3>
                        <div>
                            Evidence :
                            <span style="text-align: justify">
                                {{ $incidmgt->evidence }}
                            </span>

                            &nbsp;
                            <span>
                                Proficiency Level:
                                @if ($incidmgt->legend->id==4)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white">Awareness
                                    (A)</span>

                                @elseif ($incidmgt->legend->id==5)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white">Knowledge
                                    (K)</span>

                                @else
                                <span class="badge badge-pill"
                                    style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white">Skill
                                    (S)</span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <h4>Assessed by : {{ $incidmgt->assessedby }}</h4>
                            <div style="text-align: justify">
                                Comment:
                                {{ $incidmgt->review }}
                            </div>
                        </div>
                        <div>
                            <h4>Reviewed by : {{ $incidmgt->assessor2 }}</h4>
                            <div style="text-align: justify">
                                Review:
                                {{ $incidmgt->commentbyassessor2 }}
                                &nbsp;
                                <span>
                                    Proficiency Level:
                                    @if ($incidmgt->legend->id==4)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white">Awareness
                                        (A)</span>

                                    @elseif ($incidmgt->legend->id==5)
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white">Knowledge
                                        (K)</span>

                                    @else
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white">Skill
                                        (S)</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <br>
                        <p>
                           <!-- Button trigger modal for final assessment and approval -->
                          @if ($incidmgt->isapproved==0)
                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#commentApproveModal">
                                Comment & Approve
                            </button>
                          @endif 


                            <!-- Modal -->
                        <div class="modal fade" id="commentApproveModal" tabindex="-1" role="dialog"
                            aria-labelledby="commentApproveModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                           <span class="fa fa-check-circle-o"></span> Comment & Approve
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('incidmgt.saveassessmentbygm') }}" method="post"
                                            onsubmit="return confirm ('Submit Assessment?')">
                                            @csrf

                                                <div class="form-group">
                                                    <label for="">Final Proficiency Assessment Level <span
                                                            style="color: red">*</span></label>
                                                    <select name="profassesslevelbygm" class="form-control" required>
                                                        <option selected="disabled" value="">Select Proficiency Assessment Level</option>
                                                        @foreach ($legends as $legend)
                                                        <option value="{{ $legend->color }}">{{ $legend->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Write Review <span
                                                        style="color: red">*</span></label>
                                                    <textarea name="commentbygm" class="form-control" cols="30" rows="3"
                                                        placeholder="Your approval comment here..." required></textarea>
                                                </div>
                                                
                                                <input type="hidden" name="competenceassessment_id" value="{{ $incidmgt->competenceassessment_id }}">
                                                <input type="hidden" name="staff_id" value="{{ $incidmgt->user_id }}">
                                           
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Approve &
                                                    Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                            </p>

                            
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