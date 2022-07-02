<h4>{{ $hsriskmgt->caption }}
    <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $hsriskmgt->legend->description }}">
        <small><span class="badge badge-pill badge-primary"
                style="background-color: {{ $hsriskmgt->legend->color }}; color:white;">{{ $hsriskmgt->legend->name }}</span></small>
    </a>
</h4>
@if ($hsriskmgt->assessedbyfirst==0)
<small>
    <a href="#" data-toggle="modal"
        data-target="#modal-hsriskmgt-{{ $hsriskmgt->id }}">Assess this</a>
</small>
@else
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: purple; color: honeydew">
        Assessed by {{ $hsriskmgt->assessedby }} <span
            class="fa fa-check-circle-o"></span>
    </span>
</small>
&nbsp;
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color: honeydew">
        Proficiency Assessment by Assessor
    </span>
</small>

@endif

{{--  making the review available for the Assessor and GM  --}}
{{--  @if (($assessor->sentto_id==auth()->user()->id || auth()->user()->role_id==1 || auth()->user()->role_id==2) && $hsriskmgt->review!='')  --}}
@if ($hsriskmgt->review!='')
    &nbsp;
   
    <small>
        <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $hsriskmgt->review }}">
            <span class="badge badge-default badge-pill"
                style="background-color: rgb(214, 37, 14); color: honeydew">
                <span class="fa fa-eye"></span> Review
            </span>
        </a>
    </small>
@endif

{{--  new amendment  --}}
@if ($assessor->senttosuperior_id==auth()->user()->id && ($hsriskmgt->assessedbyfirst==1) && ($hsriskmgt->assessedbysecond==0))
{{-- <small> --}}
    <a href="#" data-toggle="modal"
        data-target="#modal-hsriskmgt-review2-{{ $hsriskmgt->id }}">Make Review</a>
{{-- </small> --}}
@endif

{{-- @if (($hsriskmgt->assessedbysecond==1) && $hsriskmgt->isapproved==0)
    <a href="#" data-toggle="modal"
    data-target="#modal-hsriskmgt-for-GM{{ $hsriskmgt->id }}">Final Review</a>
@endif --}}

<!--Modals for hsriskmgtant for review2-->
<div class="modal fade" id="modal-hsriskmgt-review2-{{ $hsriskmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsriskmgt.savesecondassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsriskmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsriskmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsriskmgt->user_id }}">
                    <input type="hidden" name="assessor2"
                        value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsriskmgt->legend->name }}"
                            style="background-color: {{ $hsriskmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsriskmgt->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Assessment</label>
                        <input type="text" class="form-control" readonly
                            @if ($hsriskmgt->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @elseif ($hsriskmgt->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsriskmgt->review }}</textarea>
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
<div class="modal fade" id="modal-hsriskmgt-{{ $hsriskmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsriskmgt.saveassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsriskmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsriskmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsriskmgt->user_id }}">
                    <input type="hidden" name="assessedby"
                        value="{{ $assessor->sentto_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsriskmgt->legend->name }}"
                            style="background-color: {{ $hsriskmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsriskmgt->evidence }}</textarea>
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
    @if (strlen($hsriskmgt->evidence)<300)
        {{ $hsriskmgt->evidence }}
        
    @else
        {{ Str::limit($hsriskmgt->evidence,300) }}

        <a href="#" data-toggle="tooltip" data-placement="right"
        title="{{ $hsriskmgt->evidence }}"> View more
        </a>
    @endif
</p>
<hr>


<!--Modals for HSWorking Environment for GMs review-->
<div class="modal fade" id="modal-hsriskmgt-for-GM{{ $hsriskmgt->id }}">
    <div class="modal-dialog">

        <form action="{{ route('hsriskmgt.saveassessmentbygm') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $hsriskmgt->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $hsriskmgt->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $hsriskmgt->user_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $hsriskmgt->legend->name }}"
                            style="background-color: {{ $hsriskmgt->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsriskmgt->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level</label>
                        <input type="text" class="form-control" readonly
                            @if ($hsriskmgt->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @elseif ($hsriskmgt->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $hsriskmgt->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $hsriskmgt->review }}</textarea>
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