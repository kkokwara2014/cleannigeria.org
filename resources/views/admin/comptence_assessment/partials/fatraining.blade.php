<h4>{{ $fatraining->caption }}
    <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $fatraining->legend->description }}">
        <small><span class="badge badge-pill badge-primary"
                style="background-color: {{ $fatraining->legend->color }}; color:white;">{{ $fatraining->legend->name }}</span></small>
    </a>
</h4>
@if ($fatraining->assessedbyfirst==0)
<small>
    <a href="#" data-toggle="modal"
        data-target="#modal-fatraining-{{ $fatraining->id }}">Assess this</a>
</small>
@else
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: purple; color: honeydew">
        Assessed by {{ $fatraining->assessedby }} <span
            class="fa fa-check-circle-o"></span>
    </span>
</small>
&nbsp;
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: {{ $fatraining->profiassebyassessor }}; color: honeydew">
        Proficiency Assessment by Assessor
    </span>
</small>

@endif

{{--  making the review available for the Assessor and GM  --}}
{{--  @if (($assessor->sentto_id==auth()->user()->id || auth()->user()->role_id==1 || auth()->user()->role_id==2) && $fatraining->review!='')  --}}
@if ($fatraining->review!='')
    &nbsp;
   
    <small>
        <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $fatraining->review }}">
            <span class="badge badge-default badge-pill"
                style="background-color: rgb(214, 37, 14); color: honeydew">
                <span class="fa fa-eye"></span> Review
            </span>
        </a>
    </small>

    &nbsp;
   
@endif

{{--  new amendment  --}}
@if ($assessor->senttosuperior_id==auth()->user()->id && ($fatraining->assessedbyfirst==1) && ($fatraining->assessedbysecond==0))
{{-- <small> --}}
    <a href="#" data-toggle="modal"
        data-target="#modal-fatraining-review2-{{ $fatraining->id }}">Make Review</a>
{{-- </small> --}}
@endif

{{-- @if (($fatraining->assessedbysecond==1) && $fatraining->isapproved==0)
    <a href="#" data-toggle="modal"
    data-target="#modal-fatraining-for-GM{{ $fatraining->id }}">Final Review</a>
@endif --}}

<!--Modals for fatrainingant for review2-->
<div class="modal fade" id="modal-fatraining-review2-{{ $fatraining->id }}">
    <div class="modal-dialog">

        <form action="{{ route('fatraining.savesecondassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $fatraining->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $fatraining->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $fatraining->user_id }}">
                    <input type="hidden" name="assessor2"
                        value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $fatraining->legend->name }}"
                            style="background-color: {{ $fatraining->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $fatraining->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Assessment</label>
                        <input type="text" class="form-control" readonly
                            @if ($fatraining->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @elseif ($fatraining->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $fatraining->review }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Second Assessor Assessment<span
                                style="color: red">*</span></label>
                        <select name="profassesslevelbyassessor2" class="form-control"
                            required>
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
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{--  end of new amendment  --}}



<!--Modals for Fatraining-->
<div class="modal fade" id="modal-fatraining-{{ $fatraining->id }}">
    <div class="modal-dialog">

        <form action="{{ route('fatraining.saveassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $fatraining->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $fatraining->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $fatraining->user_id }}">
                    <input type="hidden" name="assessedby"
                        value="{{ $assessor->sentto_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $fatraining->legend->name }}"
                            style="background-color: {{ $fatraining->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $fatraining->evidence }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level *</label>
                        <select name="profiassebyassessor" class="form-control"
                            required>
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
                        <textarea name="review" class="form-control" cols="30" rows="3"
                            required placeholder="Your review here..."></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm"
                        data-dismiss="modal">Close</button>
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
    @if (strlen($fatraining->evidence)<300)
        {{ $fatraining->evidence }}
        
    @else
        {{ Str::limit($fatraining->evidence,300) }}

        <a href="#" data-toggle="tooltip" data-placement="right"
        title="{{ $fatraining->evidence }}"> View more
        </a>
    @endif
</p>
<hr>

<!--Modals for HSWorking Environment for GMs review-->
<div class="modal fade" id="modal-fatraining-for-GM{{ $fatraining->id }}">
    <div class="modal-dialog">

        <form action="{{ route('fatraining.saveassessmentbygm') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $fatraining->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $fatraining->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $fatraining->user_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $fatraining->legend->name }}"
                            style="background-color: {{ $fatraining->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $fatraining->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level</label>
                        <input type="text" class="form-control" readonly
                            @if ($fatraining->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @elseif ($fatraining->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $fatraining->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $fatraining->review }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Proficiency Assessment Level <span
                                style="color: red">*</span></label>
                        <select name="profassesslevelbygm" class="form-control"
                            required>
                            <option selected="disabled" value="">Select Proficiency Assessment Level</option>
                            @foreach ($legends as $legend)
                            <option value="{{ $legend->name }}">{{ $legend->name }}
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
                    <button type="button" class="btn btn-default btn-sm"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Approve & Save</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->