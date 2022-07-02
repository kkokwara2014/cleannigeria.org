<h4>{{ $gastesting->caption }}
    <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $gastesting->legend->description }}">
        <small><span class="badge badge-pill badge-primary"
                style="background-color: {{ $gastesting->legend->color }}; color:white;">{{ $gastesting->legend->name }}</span></small>
    </a>
</h4>
@if ($gastesting->assessedbyfirst==0)
<small>
    <a href="#" data-toggle="modal"
        data-target="#modal-gastesting-{{ $gastesting->id }}">Assess this</a>
</small>
@else
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: purple; color: honeydew">
        Assessed by {{ $gastesting->assessedby }} <span
            class="fa fa-check-circle-o"></span>
    </span>
</small>
&nbsp;
<small>
    <span class="badge badge-default badge-pill"
        style="background-color: {{ $gastesting->profiassebyassessor }}; color: honeydew">
        Proficiency Assessment by Assessor
    </span>
</small>

@endif

{{--  making the review available for the Assessor and GM  --}}
{{--  @if (($assessor->sentto_id==auth()->user()->id || auth()->user()->role_id==1 || auth()->user()->role_id==2) && $gastesting->review!='')  --}}
@if ($gastesting->review!='')
    &nbsp;
   
    <small>
        <a href="#" data-toggle="tooltip" data-placement="top"
        title="{{ $gastesting->review }}">
            <span class="badge badge-default badge-pill"
                style="background-color: rgb(214, 37, 14); color: honeydew">
                <span class="fa fa-eye"></span> Review
            </span>
        </a>
    </small>

    &nbsp;
   
   
@endif

{{--  new amendment  --}}
@if ($assessor->senttosuperior_id==auth()->user()->id && ($gastesting->assessedbyfirst==1) && ($gastesting->assessedbysecond==0))
{{-- <small> --}}
    <a href="#" data-toggle="modal"
        data-target="#modal-gastesting-review2-{{ $gastesting->id }}">Make Review</a>
{{-- </small> --}}
@endif

{{-- @if (($gastesting->assessedbysecond==1) && $gastesting->isapproved==0)
    <a href="#" data-toggle="modal"
    data-target="#modal-gastesting-for-GM{{ $gastesting->id }}">Final Review</a>
@endif --}}

<!--Modals for gastestingant for review2-->
<div class="modal fade" id="modal-gastesting-review2-{{ $gastesting->id }}">
    <div class="modal-dialog">

        <form action="{{ route('gastesting.savesecondassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $gastesting->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $gastesting->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $gastesting->user_id }}">
                    <input type="hidden" name="assessor2"
                        value="{{ auth()->user()->firstname.' '.auth()->user()->lastname }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $gastesting->legend->name }}"
                            style="background-color: {{ $gastesting->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $gastesting->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">First Assessor Assessment</label>
                        <input type="text" class="form-control" readonly
                            @if ($gastesting->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @elseif ($gastesting->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">First Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $gastesting->review }}</textarea>
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



<!--Modals for Gas Testing-->
<div class="modal fade" id="modal-gastesting-{{ $gastesting->id }}">
    <div class="modal-dialog">

        <form action="{{ route('gastesting.saveassessment') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $gastesting->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $gastesting->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $gastesting->user_id }}">
                    <input type="hidden" name="assessedby"
                        value="{{ $assessor->sentto_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $gastesting->legend->name }}"
                            style="background-color: {{ $gastesting->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $gastesting->evidence }}</textarea>
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
    @if (strlen($gastesting->evidence)<300)
        {{ $gastesting->evidence }}
        
    @else
        {{ Str::limit($gastesting->evidence,300) }}

        <a href="#" data-toggle="tooltip" data-placement="right"
        title="{{ $gastesting->evidence }}"> View more
        </a>
    @endif
</p>

<hr>


<!--Modals for HSWorking Environment for GMs review-->
<div class="modal fade" id="modal-gastesting-for-GM{{ $gastesting->id }}">
    <div class="modal-dialog">

        <form action="{{ route('gastesting.saveassessmentbygm') }}" method="post"
            onsubmit="return confirm ('Submit your Assessment?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Assessment for {{ $gastesting->caption }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id"
                        value="{{ $gastesting->competenceassessment_id }}">
                    <input type="hidden" name="staff_id"
                        value="{{ $gastesting->user_id }}">

                    <div class="form-group">
                        <label for="">Self Proficiency Assessment</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $gastesting->legend->name }}"
                            style="background-color: {{ $gastesting->legend->color }}; color:white">
                    </div>
                    <div class="form-group">
                        <label for="">Available Evidence</label>
                        <textarea name="evidence" class="form-control" cols="30"
                            rows="3" readonly>{{ $gastesting->evidence }}</textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Assessor Proficiency Assessment Level</label>
                        <input type="text" class="form-control" readonly
                            @if ($gastesting->profiassebyassessor=='orange')
                                value="Awareness (A)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @elseif ($gastesting->profiassebyassessor=='green')
                                value="Knowledge (K)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @else
                                value="Skill (S)"
                                style="background-color: {{ $gastesting->profiassebyassessor }}; color:white"
                            @endif                                                            
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Assessor Review</label>
                        <textarea name="review" class="form-control" cols="30"
                            rows="3" readonly>{{ $gastesting->review }}</textarea>
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