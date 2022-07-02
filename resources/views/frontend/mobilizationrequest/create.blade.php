@extends('frontend.layout.main')

@section('title','Mobilization Request Form')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h3 class="text-center">@yield('title')</h3>
                    <div class="text-center">(Initial Incident Form)</div>
                    <div class="text-center" style="color: red"><strong>Note: Please call the General Manager before e-mailing this form.</strong></div>
                    <div>
                        <strong style="color: red">Guidance:</strong> On receiving completed mobilization form,
                        CNA Responders and Equipment shall be on standby
                        pending CNA General Managers’ approval to mobilize.
                        Note that equipment and personnel charges begin
                        upon form submission.
                    </div><br>

                    <p>
                        @include('frontend.messages.success')
                    </p>
                    <form action="{{ route('mobrequest.save') }}" method="post">
                        {{ csrf_field() }}
                        @honeypot
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 1 - Contact Details</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group-sm">
                                            <label>Member Company/Spiller <i style="color: #ff0000;">*</i></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('membcomp') ? ' is-invalid' : '' }}"
                                                id="membcomp" name="membcomp" placeholder="Member Company/Spiller"
                                                autofocus value="{{ old('membcomp') }}">
                                            @if ($errors->has('membcomp'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('membcomp','Enter Member Company') }}</span
                                                    style="color: red">
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Name of Person Notifying CNA <i style="color: #ff0000;">*</i></label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('notifier') ? ' is-invalid' : '' }}"
                                                id="notifier" name="notifier"
                                                placeholder="Name of Person Notifying CNA" value="{{ old('notifier') }}">
                                            @if ($errors->has('notifier'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('notifier','Enter Notifier') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Job Title (Designation)</label>
                                            <input type="text" class="form-control" id="designation" name="designation"
                                                placeholder="Job Title (Designation)" value="{{ old('designation') }}">
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Direct Phone Number</label>
                                            <input type="tel" class="form-control" id="directphone" name="directphone"
                                                placeholder="Direct Phone Number" maxlength="11" pattern="[0-9]+" value="{{ old('directphone') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group-sm">
                                            <label>Mobile Phone Number <i style="color: #ff0000;">*</i></label>
                                            <input type="tel"
                                                class="form-control{{ $errors->has('mobilephone') ? ' is-invalid' : '' }}"
                                                id="mobilephone" name="mobilephone" placeholder="Mobile Phone Number"
                                                maxlength="11" pattern="[0-9]+" value="{{ old('mobilephone') }}">
                                            @if ($errors->has('mobilephone'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('mobilephone','Enter Mobile Phone Number') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Email Address <i style="color: #ff0000;">*</i></label>
                                            <input type="email"
                                                class="form-control{{ $errors->has('mobilephone') ? ' is-invalid' : '' }}"
                                                id="email" name="email" placeholder="Email Address" maxlength="50" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('email','Enter Email Address') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Command Centre Number (if any)</label>
                                            <input type="text" class="form-control" id="centrenumb" name="centrenumb"
                                                placeholder="Command Centre Number" value="{{ old('centrenumb') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group-sm">
                                                    <label>Date of Activation <i style="color: #ff0000;">*</i></label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('dateofact') ? ' is-invalid' : '' }}"
                                                        id="datepicker" name="dateofact"
                                                        placeholder="Date of Activation" value="{{ old('dateofact') }}">
                                                    @if ($errors->has('dateofact'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <span
                                                            style="color: red">{{ $errors->first('dateofact','Enter Activation date') }}</span>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group-sm">
                                                    <label>Time of Activation <i style="color: #ff0000;">*</i></label>
                                                    <input type="time"
                                                        class="form-control{{ $errors->has('timeofact') ? ' is-invalid' : '' }}"
                                                        id="timeofact" name="timeofact" value="{{ old('timeofact') }}">
                                                    @if ($errors->has('timeofact'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <span
                                                            style="color: red">{{ $errors->first('timeofact','Enter Activation time') }}</span>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 2 - Spill Details</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group-sm">
                                            <label>Date of Spill <i style="color: #ff0000;">*</i></label>
                                            <input type="text" id="datepicker1"
                                                class="form-control{{ $errors->has('spilldate') ? ' is-invalid' : '' }}"
                                                name="spilldate" placeholder="Date of Spill" value="{{ old('spilldate') }}">
                                            @if ($errors->has('spilldate'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('spilldate','Enter Date of Spill') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Time of Spill</label>
                                            <input type="time" class="form-control" id="spilltime" name="spilltime" value="{{ old('spilltime') }}">
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Source of Spill</label>
                                            <input type="text" class="form-control" id="spillsource" name="spillsource" value="{{ old('spillcource') }}" placeholder="Source of Spill">
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Cause of Spill</label>
                                            <input type="text" class="form-control" id="spillcause" name="spillcause" value="{{ old('spillcause') }}" placeholder="Cause of Spill">
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Name of Location/Facility</label>
                                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" placeholder="Location/Facility">
                                        </div>
                                        <div class="form-group-sm">
                                            <label>Name of Nearby Town/Community</label>
                                            <input type="text" class="form-control" id="town" name="town" value="{{ old('town') }}" placeholder="Nearby Town or Community">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group-sm">
                                            <label>Status of Spill <i style="color: #ff0000;">*</i></label>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="spillstatus" value="Secured">
                                                                Secured
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="spillstatus"
                                                                    value="Uncontrolled">
                                                                Uncontrolled
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="spillstatus" value="Unknown">
                                                                Unknown
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('spillstatus'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <span
                                                            style="color: red">{{ $errors->first('spillstatus','Select at least one status') }}</span>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <label>Type of Production</label>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="productiontype"
                                                                    value="Pipeline">
                                                                Pipeline
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="productiontype"
                                                                    value="Flow Line">
                                                                Flow Line
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="productiontype"
                                                                    value="Flow Station">
                                                                Flow Station
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <label>Facility/Installation</label>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="Wellhead">
                                                                Wellhead
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="Manifold">
                                                                Manifold
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="Gas Plant">
                                                                Gas Plant
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="FPSO">
                                                                FPSO
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="Tank Farm">
                                                                Tank Farm
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="facility" value="Others">
                                                                Others
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 3 - Location</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Type of Environment <i style="color: #ff0000;">*</i></label>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="OffShore">
                                                Offshore
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Subsea">
                                                Subsea
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Shoreline">
                                                Shoreline
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Estuary">
                                                Estuary
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Swamp">
                                                Swamp
                                            </label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Port">
                                                Port
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Harbour">
                                                Harbour
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Inland">
                                                Inland
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="River">
                                                River
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="environmenttype" value="Seasonal Swamp">
                                                Seasonal Swamp
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('environmenttype'))
                                    <span class="invalid-feedback" role="alert">
                                        <span
                                            style="color: red">{{ $errors->first('environmenttype','Select at least one Environment') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 4 - Resources at Risk (if
                                        available)</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Environmental or socio-economic sensitivities that may be impacted.
                                        Provide the relevant oil spill Contingency
                                        plan and sensitivity maps if available</label>
                                    <textarea class="form-control" name="res_at_risk" rows="3"
                                        placeholder="Include Contingency/Sensitive Map" value="{{ old('res_at_risk') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 5 - Equipment Required and
                                        Personnel</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Number of Personnel & Equipment to be mobilized by CNA <i
                                            style="color: #ff0000;">*</i></label>
                                    <textarea class="form-control{{ $errors->has('numofpersonnel') ? ' is-invalid' : '' }}" name="numofpersonnel" rows="3"
                                        placeholder="Number of Personnel & Equipment to be mobilized by CNA" value="{{ old('numofpersonnel') }}"></textarea>
                                    <span class="text-danger"></span>
                                    @if ($errors->has('numofpersonnel'))
                                    <span class="invalid-feedback" role="alert">
                                        <span
                                            style="color: red">{{ $errors->first('numofpersonnel','This information is required') }}</span>
                                    </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 6 - Health, Safety and Security</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Describe Location specific COVID-19 Protection Protocol <i style="color: #ff0000;"> *</i>
                                    </label>
                                    <textarea class="form-control{{ $errors->has('safetyinfo1') ? ' is-invalid' : '' }}" name="safetyinfo1" rows="3"
                                        placeholder="Describe Location specific COVID-19 Protection Protocol" value="{{ old('safetyinfo1') }}"></textarea>
                                        @if ($errors->has('safetyinfo1'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('safetyinfo1','This information is required') }}</span>
                                        </span>
                                        @endif
                                </div>
                                <div class="form-group-sm">
                                    <label>Describe Crew change requirements <i style="color: #ff0000;"> *</i>
                                    </label>
                                    <textarea class="form-control{{ $errors->has('safetyinfo2') ? ' is-invalid' : '' }}" name="safetyinfo2" rows="3"
                                        placeholder="Describe Crew change requirements" value="{{ old('safetyinfo2') }}"></textarea>
                                        @if ($errors->has('safetyinfo2'))
                                    <span class="invalid-feedback" role="alert">
                                        <span
                                            style="color: red">{{ $errors->first('safetyinfo2','This information is required') }}</span>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group-sm">
                                    <label>Highlight any known safety or security risks
                                        (e.g. concurrent operation, robbery prone area etc.)
                                    </label>
                                    <textarea class="form-control" name="safetyinfo3" rows="3"
                                        placeholder="Highlight any known safety or security risks" value="{{ old('safetyinfo3') }}"></textarea>
                                </div>
                                <div class="form-group-sm">
                                    <label>Describe security arrangements for CNA staff</label>
                                    <textarea class="form-control" name="safetyinfo4" rows="3"
                                        placeholder="Describe security arrangements for CNA staff" value="{{ old('safetyinfo4') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Section 7 - Further Information</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Additional Information</label>
                                    <textarea class="form-control" name="addedinfo" rows="3"
                                        placeholder="Additional Information" value="{{ old('addedinfo') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div>
                                    <strong>On behalf of my organization, I/We hereby commit to provide the following
                                        arrangement for mobilization and demobilization of CNA to/fro incident
                                        location.</strong>
                                    <i style="color: #ff0000;"> *</i>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required name="provision[]" value="COVID-19 PPE" /> COVID-19 PPE
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Decent Accomodation" /> Decent Accomodation
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Safety of Location" /> Safety
                                        of Location (Location Risk Assessment & Control Measures)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Security" /> Security (Armed
                                        Escort & Protection)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Transportation" />
                                        Transportation (Equipment & Personnel)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Communication" /> Communication
                                        (Radios, Pagers etc)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Access to/fro" /> Access to/fro
                                        incident site (Boats, Vessel, Hovercraft etc)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="On-Site First Aid" /> On-site
                                        Medical services (First aid, Medic etc)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]" value="Welfare" /> Welfare (Food,
                                        Water, Snacks etc)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="provision[]"
                                            value="Provision of safety critical devices" /> Provision of safety critical
                                        devices. Intrinsically safe cameras, gas testers etc.
                                    </label>
                                </div>
                                @if ($errors->has('provision'))
                                    <span class="invalid-feedback" role="alert">
                                        <span
                                            style="color: red">{{ $errors->first('provision','Select at least one provision') }}</span>
                                    </span>
                                    @endif
                            </div>
                        </div>

                        <div class="panel panel-heading-color">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <strong class="panel-heading-text-color">Please, State applicable welfare
                                        provisions</strong>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-bg" style="font-size: 14px;">
                                <div class="form-group-sm">
                                    <label>Applicable Welfare Provisions</label>
                                    <textarea class="form-control" name="welfareprov" rows="3"
                                        placeholder="Applicable Welfare Provisions" value="{{ old('welfareprov') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div style="color: red; text-align: justify">
                            <strong>Please note: Response services are guaranteed ONLY for members.
                                Non-members will be required to sign a third-party agreement before a
                                response is initiated.
                                A work order will need to be completed before responders arrive and begin a
                                response.
                            </strong>
                        </div>

                        <input type="submit" class="btn btn-success btn-sm" value="Submit" />

                    </form>
                    <br />
                </div>

                <div class="col-md-3 text-justify">
                    <div class="col-sm-12">
                        @include('frontend.layout.sidebar')
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>


@endsection
