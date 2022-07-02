<h4>{{ $hsworkenv->caption }}
    <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $hsworkenv->legend->description }}">
        <small><span class="badge badge-pill badge-primary"
                style="background-color: {{ $hsworkenv->legend->color }}; color:white;">{{ $hsworkenv->legend->name }}</span></small>
    </a>
</h4>

@if (($hsworkenv->assessedbyfirst==0))
<small>
    <a href="#" data-toggle="modal"
        data-target="#modal-hsworkenv-{{ $hsworkenv->id }}">Assess this</a>
</small>
{{-- @elseif($hsworkenv->assessedbyfirst==1) --}}
@else
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: purple; color: honeydew">
        Assessed by {{ $hsworkenv->assessedby }} <span
            class="fa fa-check-circle-o"></span>
    </span>
</small>
&nbsp;
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: {{ $hsworkenv->profiassebyassessor }}; color: honeydew">
        Proficiency Assessment by Assessor
    </span>
</small>

@endif

{{--  making the review available for the Assessor and GM  --}}
{{--  @if (($assessor->sentto_id==auth()->user()->id || auth()->user()->role_id==1 || auth()->user()->role_id==2) && $hsworkenv->review!='')  --}}
@if ($hsworkenv->review!='')
    &nbsp;
   
    <small>
        <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $hsworkenv->review }}">
            <span class="badge badge-default badge-pill"
                style="background-color: rgb(214, 37, 14); color: honeydew">
                <span class="fa fa-eye"></span> Review
            </span>
        </a>
    </small>

   
@endif

{{--  new amendment  --}}
@if ($comptassuser->senttosuperior_id==auth()->user()->id && ($hsworkenv->assessedbyfirst==1) && ($hsworkenv->assessedbysecond==0))
{{-- <small> --}}
    <a href="#" data-toggle="modal"
        data-target="#modal-hsworkenv-review2-{{ $hsworkenv->id }}">Make Review</a>
{{-- </small> --}}
@endif

{{-- @if (($hsworkenv->assessedbysecond==1) && $hsworkenv->isapproved==0)
    <a href="#" data-toggle="modal"
    data-target="#modal-hsworkenv-for-GM{{ $hsworkenv->id }}">Final Review</a>
@endif --}}

<!--Modals for hsworkenvant for review2-->
<div class="modal fade" id="modal-hsworkenv-review2-{{ $hsworkenv->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsworkenv.savesecondassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsworkenv->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsworkenv->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsworkenv->user_id }}">
                    <input type="hidden" name="assessor2"
                        value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsworkenv->legend->name }}"
                            style="background-color: {{ $hsworkenv->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsworkenv->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Assessment</label>
                        <input type="text" class="form-control" readonly
                            @if ($hsworkenv->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @elseif ($hsworkenv->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsworkenv->review }}</textarea>
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


<!--Modals for HSWorking Environment-->
<div class="modal fade" id="modal-hsworkenv-{{ $hsworkenv->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsworkenv.saveassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsworkenv->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsworkenv->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsworkenv->user_id }}">
                    <input type="hidden" name="assessedby"
                        value="{{ $assessor->sentto_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsworkenv->legend->name }}"
                            style="background-color: {{ $hsworkenv->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsworkenv->evidence }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level <span
                                style="color: red">*</span></label>
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
    @if (strlen($hsworkenv->evidence)<300)
    {{ $hsworkenv->evidence }}
    
@else
    {{ Str::limit($hsworkenv->evidence,300) }}

    <a href="#" data-toggle="tooltip" data-placement="right"
    title="{{ $hsworkenv->evidence }}"> View more
    </a>
@endif
</p>
<hr>

<!--Modals for HSWorking Environment for GMs review-->
<div class="modal fade" id="modal-hsworkenv-for-GM{{ $hsworkenv->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsworkenv.saveassessmentbygm') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsworkenv->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsworkenv->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsworkenv->user_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsworkenv->legend->name }}"
                            style="background-color: {{ $hsworkenv->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsworkenv->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level</label>
                        <input type="text" class="form-control" readonly
                            @if ($hsworkenv->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @elseif ($hsworkenv->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $hsworkenv->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsworkenv->review }}</textarea>
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
