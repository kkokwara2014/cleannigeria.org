@if (($hsworkenv->assessedbyfirst==1 && $hsrisk->assessedbyfirst==1
&& $hsriskmgt->assessedbyfirst==1 && $fatraining->assessedbyfirst==1
&& $gastesting->assessedbyfirst==1 && $ophandover->assessedbyfirst==1
&& $forkliftop->assessedbyfirst==1 && $selfloader->assessedbyfirst==1
&& $powerdriven->assessedbyfirst==1 && $respequip->assessedbyfirst==1
&& $miscresp->assessedbyfirst==1 && $fateoil->assessedbyfirst==1
&& $impoilpollu->assessedbyfirst==1 && $survmodviz->assessedbyfirst==1
&& $offshoreresp->assessedbyfirst==1 && $shorelineresp->assessedbyfirst==1 && $inlandresp->assessedbyfirst==1)
)

<h4>{{ $incidmgt->caption }}
    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $incidmgt->legend->description }}">
        <small><span class="badge badge-pill badge-primary"
                style="background-color: {{ $incidmgt->legend->color }}; color:white;">{{ $incidmgt->legend->name }}</span></small>
    </a>
</h4>
@if ($incidmgt->assessedbyfirst==0)
<small>
    <a href="#" data-toggle="modal" data-target="#modal-incidmgt-{{ $incidmgt->id }}">Assess this</a>
</small>
@else
<small>
    <span class="badge badge-default badge-pill" style="background-color: purple; color: honeydew">
        Assessed by {{ $incidmgt->assessedby }} <span class="fa fa-check-circle-o"></span>
    </span>
</small>
&nbsp;
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: {{ $incidmgt->profiassebyassessor }}; color: honeydew">
        Proficiency Assessment by Assessor
    </span>
</small>

@endif
{{-- making the review available for the Assessor and GM  --}}
{{-- @if (($assessor->sentto_id==auth()->user()->id || auth()->user()->role_id==1 || auth()->user()->role_id==2) && $incidmgt->review!='')  --}}
@if ($incidmgt->review!='')
&nbsp;

<small>
    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $incidmgt->review }}">
        <span class="badge badge-default badge-pill" style="background-color: rgb(214, 37, 14); color: honeydew">
            <span class="fa fa-eye"></span> Review
        </span>
    </a>
</small>

@endif

{{-- new amendment  --}}
@if ($assessor->senttosuperior_id==auth()->user()->id && ($incidmgt->assessedbyfirst==1) &&
($incidmgt->assessedbysecond==0))
{{-- <small> --}}
    <a href="#" data-toggle="modal" data-target="#modal-incidmgt-review2-{{ $incidmgt->id }}">Make Review</a>
{{-- </small> --}}
@endif

{{-- @if ((auth()->user()->role_id==1 || auth()->user()->role_id==2) && ($incidmgt->assessedbysecond==1) && --}}
@if (($incidmgt->assessedbysecond==1) &&
($hsworkenv->assessedbysecond==1 && $hsrisk->assessedbysecond==1
&& $hsriskmgt->assessedbysecond==1 && $fatraining->assessedbysecond==1
&& $gastesting->assessedbysecond==1 && $ophandover->assessedbysecond==1
&& $forkliftop->assessedbysecond==1 && $selfloader->assessedbysecond==1
&& $powerdriven->assessedbysecond==1 && $respequip->assessedbysecond==1
&& $miscresp->assessedbysecond==1 && $fateoil->assessedbysecond==1
&& $impoilpollu->assessedbysecond==1 && $survmodviz->assessedbysecond==1
&& $offshoreresp->assessedbysecond==1
&& $shorelineresp->assessedbysecond==1 && $inlandresp->assessedbysecond==1) && $incidmgt->isapproved==0 &&
($assessor->finalassessor_id==auth()->user()->id))

<a href="{{ route('makefinalassessment',[$incidmgt->competenceassessment_id,$incidmgt->user_id]) }}">Final Review</a>
{{-- <a href="#" data-toggle="modal" data-target="#modal-incidmgt-for-GM{{ $incidmgt->id }}">Final Review</a> --}}
@endif

<!--Modals for incidmgtant for review2-->
<div class="modal fade" id="modal-incidmgt-review2-{{ $incidmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('incidentmgt.savesecondassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $incidmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $incidmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id" value="{{ $incidmgt->user_id }}">
                    <input type="hidden" name="assessor2"
                        value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly value="{{ $incidmgt->legend->name }}"
                            style="background-color: {{ $incidmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Assessment</label>
                        <input type="text" class="form-control" readonly @if ($incidmgt->profiassebyassessor=='orange')
                        value="Awareness (A)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @elseif ($incidmgt->profiassebyassessor=='green')
                        value="Knowledge (K)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @else
                        value="Skill (S)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->review }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Second Assessor Assessment<span style="color: red">*</span></label>
                        <select name="profassesslevelbyassessor2" class="form-control" required>
                            <option selected="disabled" value="">Select Proficiency Assessment Level</option>
                            @foreach ($legends as $legend)
                            <option value="{{ $legend->color }}">{{ $legend->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Write Review</label>
                        <textarea name="commentbyassessor2" class="form-control" cols="30" rows="3"
                            placeholder="Your review comment here..."></textarea>
                    </div>


                    @if (($hsworkenv->assessedbysecond==1 && $hsrisk->assessedbysecond==1
                    && $hsriskmgt->assessedbysecond==1 && $fatraining->assessedbysecond==1
                    && $gastesting->assessedbysecond==1 && $ophandover->assessedbysecond==1
                    && $forkliftop->assessedbysecond==1 && $selfloader->assessedbysecond==1
                    && $powerdriven->assessedbysecond==1 && $respequip->assessedbysecond==1
                    && $miscresp->assessedbysecond==1 && $fateoil->assessedbysecond==1
                    && $impoilpollu->assessedbysecond==1 && $survmodviz->assessedbysecond==1
                    && $offshoreresp->assessedbysecond==1 && $shorelineresp->assessedbysecond==1 &&
                    $inlandresp->assessedbysecond==1))

                    <div class="form-group">
                        <label>Select Final Assessor <span style="color: red">*</span></label>
                        <select name="finalassessor_id" class="form-control" required>
                            <option selected="disabled" value="">Select Final Assessor</option>
                            @foreach ($finalassessors as $senttosup)
                            <option value="{{ $senttosup->id }}">
                                {{ $senttosup->firstname.' '.$senttosup->lastname.' - '.$senttosup->email }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{-- end of new amendment  --}}

<!--Modals for HSWorking Environment-->
<div class="modal fade" id="modal-incidmgt-{{ $incidmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('incidentmgt.saveassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $incidmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $incidmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id" value="{{ $incidmgt->user_id }}">
                    <input type="hidden" name="assessedby" value="{{ $assessor->sentto_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly value="{{ $incidmgt->legend->name }}"
                            style="background-color: {{ $incidmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->evidence }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level <span style="color: red">*</span></label>
                        <select name="profiassebyassessor" class="form-control" required>
                            <option selected="disabled" value="">Select Assessor
                                Proficiency Assessment Level</option>
                            @foreach ($legends as $legend)
                            <option value="{{ $legend->color }}">{{ $legend->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Write Review <span style="color: red">*</span></label>
                        <textarea name="review" class="form-control" cols="30" rows="3" required
                            placeholder="Your review here..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Select Next Assessor <span style="color: red">*</span></label>
                        <select name="senttosuperior_id" class="form-control" required>
                            <option selected="disabled" value="">Select Next Assessor</option>
                            @foreach ($senttosuperiors as $senttosup)
                            <option value="{{ $senttosup->id }}">
                                {{ $senttosup->firstname.' '.$senttosup->lastname.' - '.$senttosup->email }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<p style="text-align: justify">
    @if (strlen($incidmgt->evidence)<300) {{ $incidmgt->evidence }}

        @else
        {{ Str::limit($incidmgt->evidence,300) }}

        <a href="#" data-toggle="tooltip" data-placement="right" title="{{ $incidmgt->evidence }}"> View more
        </a>
        @endif
</p>
<hr>

<!--Modals for Incident Management for GMs review-->
<div class="modal fade" id="modal-incidmgt-for-GM{{ $incidmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('incidmgt.saveassessmentbygm') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Final Assessment for {{ $incidmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $incidmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id" value="{{ $incidmgt->user_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly value="{{ $incidmgt->legend->name }}"
                            style="background-color: {{ $incidmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Proficiency Assessment Level</label>
                        <input type="text" class="form-control" readonly @if ($incidmgt->profiassebyassessor=='orange')
                        value="Awareness (A)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @elseif ($incidmgt->profiassebyassessor=='green')
                        value="Knowledge (K)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @else
                        value="Skill (S)"
                        style="background-color: {{ $incidmgt->profiassebyassessor }}; color:white"
                        @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->review }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Second Assessor Proficiency Assessment Level</label>
                        
                        
                        <input type="text" class="form-control" readonly @if ($incidmgt->profassesslevelbyassessor2=='orange')
                        value="Awareness (A)"
                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white"
                        @elseif ($incidmgt->profassesslevelbyassessor2=='green')
                        value="Knowledge (K)"
                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white"
                        @else
                        value="Skill (S)"
                        style="background-color: {{ $incidmgt->profassesslevelbyassessor2 }}; color:white"
                        @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Second Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30" rows="3"
                            readonly>{{ $incidmgt->commentbyassessor2 }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Final Proficiency Assessment Level <span style="color: red">*</span></label>
                        <select name="profassesslevelbygm" class="form-control" required>
                            <option selected="disabled" value="">Select Proficiency Assessment Level</option>
                            @foreach ($legends as $legend)
                            <option value="{{ $legend->color }}">{{ $legend->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Write Review</label>
                        <textarea name="commentbygm" class="form-control" cols="30" rows="3"
                            placeholder="Your review comment here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Approve & Save</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endif