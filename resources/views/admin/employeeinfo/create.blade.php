@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">Employee Information</a>
        </p>

        <div class="row">
            <div class="col-md-11">
                {{-- for messages --}}
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('employees.store') }}" method="post">
                            {{ csrf_field() }}


                            <h3>Personal Information</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Employee Name & Phone Number</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->firstname.' '.Auth::user()->lastname.' - '.Auth::user()->phone }}"
                                            readonly>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Title *</label>
                                        <select name="title" class="form-control" required>
                                            <option selected="disabled" value="">Select Title</option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Dr. Mrs.">Dr. Mrs.</option>
                                            <option value="Engr. Dr.">Engr. Dr.</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Date of Birth *</label>
                                        <input type="text" id="datepicker1" class="form-control" name="dob"
                                            value="{{ old('dob') }}" required placeholder="Date of Birth">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Employee Address *</label>
                                        <textarea name="address" class="form-control" cols="30" rows="4"
                                            placeholder="Residential Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" class="form-control" name="city" value="{{ old('city') }}"
                                            placeholder="City e.g Port Harcourt">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">State *</label>
                                        <select name="state_id" class="form-control" required>
                                            <option selected="disabled" value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">LGA *</label>
                                        <select name="lga_id" class="form-control" required>

                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Marital Status *</label>
                                        <select id="marital" name="maritalstatus" class="form-control" required>
                                            <option selected="disabled" value="">Select Marital Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>

                                        </select>
                                    </div>

                                    <div id="spousedetails">
                                        <div class="form-group">
                                            <label for="">Name of Spouse</label>
                                            <input type="text" class="form-control" name="spousename"
                                                value="{{ old('spousename') }}" placeholder="Spouse Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Spouse Employer</label>
                                            <input type="text" class="form-control" name="spouseemployer"
                                                value="{{ old('spouseemployer') }}" placeholder="Spouse Employer">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Spouse Phone</label>
                                            <input type="text" class="form-control" name="spousephone"
                                                value="{{ old('spousephone') }}" placeholder="Spouse Phone" maxlength="11" pattern="[0-9]+">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>Job Information</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Qualification *</label>
                                        <select name="qualification" class="form-control" required>
                                            <option selected="disabled" value="">Select Qualification</option>
                                            <option value="PhD">Ph.D</option>
                                            <option value="MSc">MSc</option>
                                            <option value="MEd">MEd</option>
                                            <option value="MBA">MBA</option>
                                            <option value="MA">MA</option>
                                            <option value="PGD">PGD</option>
                                            <option value="PGDE">PGDE</option>
                                            <option value="BA">BA</option>
                                            <option value="BSc">BSc</option>
                                            <option value="HND">HND</option>
                                            <option value="BEd">BEd</option>
                                            <option value="ND">ND</option>
                                            <option value="NCE">NCE</option>
                                            <option value="O-level">O-level</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Profession *</label>
                                        <input type="text" class="form-control" name="profession"
                                            value="{{ old('profession') }}" required placeholder="Profession">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Job Title *</label>
                                        <input type="text" name="jobtitle" class="form-control" placeholder="Job Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Supervisor <strong style="color:red">*</strong></label>
                                        <input id="supervisor" type="text"
                                            class="form-control{{ $errors->has('supervisor') ? ' is-invalid' : '' }}"
                                            name="supervisor" value="{{ old('supervisor') }}" autofocus
                                            placeholder="Supervisor">

                                        @if ($errors->has('supervisor'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('supervisor') }}</span>
                                        </span>
                                        @endif

                                    </div>

                                </div>
                                <div class="col-md-6">

                                    

                                    <div class="form-group">
                                        <label for="">Staff Location <strong style="color:red;">*</strong></label>
                                        <select name="location_id" class="form-control">
                                            <option selected="disabled">Select Staff Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Date of Employment <strong style="color:red">*</strong></label>
                                        <input id="datepicker2" type="text"
                                            class="form-control{{ $errors->has('dateofemployment') ? ' is-invalid' : '' }}"
                                            name="dateofemployment" value="{{ old('dateofemployment') }}" autofocus
                                            placeholder="Date of Employment">

                                        @if ($errors->has('dateofemployment'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('dateofemployment') }}</span>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="">Contract End Date </label>
                                        <input id="datepicker3" type="text"
                                            class="form-control"
                                            name="contractenddate" value="{{ old('contractenddate') }}" autofocus
                                            placeholder="Contract End Date">
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <h3>Emergency Contact</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Next of Kin <strong style="color:red">*</strong></label>
                                        <input id="nextofkin" type="text"
                                            class="form-control{{ $errors->has('nextofkin') ? ' is-invalid' : '' }}"
                                            name="nextofkin" value="{{ old('nextofkin') }}" autofocus
                                            placeholder="Next of Kin">

                                        @if ($errors->has('nextofkin'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('nextofkin') }}</span>
                                        </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="">Next of Kin Phone <strong style="color:red">*</strong></label>
                                        <input id="nokphone" type="tel"
                                            class="form-control{{ $errors->has('nokphone') ? ' is-invalid' : '' }}"
                                            name="nokphone" value="{{ old('nokphone') }}"
                                            placeholder="Next of Kin Phone" maxlength="11" pattern="[0-9]+">

                                        @if ($errors->has('nokphone'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('nokphone') }}</span>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="">Relationship *</label>
                                        <select name="nokrelationship" class="form-control" required>
                                            <option selected="disabled" value="">Select Relationship</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Child">Child</option>
                                            <option value="Cousin">Cousin</option>
                                            <option value="Nephew">Nephew</option>
                                            <option value="Niece">Niece</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Uncle">Uncle</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label for="">Next of Kin Address <strong style="color:red">*</strong></label>
                                        <textarea type="text"
                                            class="form-control{{ $errors->has('nokaddress') ? ' is-invalid' : '' }}"
                                            name="nokaddress" value="{{ old('nokaddress') }}"
                                            placeholder="Next of Kin Address" cols="30" rows="7"></textarea>

                                        @if ($errors->has('nokaddress'))
                                        <span class="invalid-feedback" role="alert">
                                            <span style="color: red">{{ $errors->first('nokaddress') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="acceptdeclaration" required> <small
                                                style="color: red; text-align: justify">[I declare the above information
                                                is, to the best of my knowledge,
                                                true and accurate. I understand that a breach of confidentiality
                                                guidelines
                                                and any false statements made above or any official document (resume,
                                                applications, etc),
                                                could disqualify me from employment or constitute grounds for dismissal
                                                without notice or pay in lieu thereof. I understand that the information
                                                on this form is collected by Clean Nigeria Associates Ltd/Gte to
                                                administer
                                                my employment relationship with Clean Nigeria Associates Ltd/Gte on her
                                                Labour Supply Contractor. By providing this information, I consent to
                                                its
                                                use for that purpose.]</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <a href="{{ route('employees.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>

                        </form>


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