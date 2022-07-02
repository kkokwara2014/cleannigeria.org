@extends('admin.layout.app')

@section('title')
Make Maintenance Request
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

                
                <p>
                    <a href="{{ route('maintenancerequest.index') }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-plus"></span> All Maintenance Requests</a>
                </p>
               

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                    <form action="{{ route('maintenancerequest.store') }}" method="post">
                       @csrf
                        <h4>Section 1 - Contact Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Member Company <span style="color:red">*</span> </label>
                                    <input type="text" name="membercompany" class="form-control" value="{{ $user->company->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Notifying Person <span style="color:red">*</span></label>
                                    <input type="text" name="notifyingperson" class="form-control" value="{{ $user->firstname.' '.$user->lastname }}" readonly>
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="maintcode" value="{{ rand(34567,89012) }}">
                                </div>
                                <div class="form-group">
                                    <label>Job Designation <span style="color:red">*</span></label>
                                    <input type="text" name="jobdesignation" class="form-control" placeholder="Job Designation" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Direct Phone <span style="color:red">*</span></label>
                                    <input type="text" name="directphone" class="form-control" placeholder="Direct phone" required pattern="[0-9]+" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label>Email <span style="color:red">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <label>Date/Time of Request <span style="color:red">*</span></label>
                                    <input type="text" name="dateofrequest" class="form-control" placeholder="Request Date" value="{{ date('d M, Y H:i:s') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Section 2 - Equipment Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Equipment Type <span style="color:red">*</span> </label>
                                    <input type="text" name="equipmenttype" class="form-control" placeholder="Equipment Type" required>
                                </div>
                                <div class="form-group">
                                    <label>Equipment Location <span style="color:red">*</span></label>
                                    <input type="text" name="equipmentlocation" class="form-control" placeholder="Equipment Location" required>
                                </div>
                                <div class="form-group">
                                    <label>Maintenance Type <span style="color:red">*</span></label>
                                    <input type="text" name="mainttype" class="form-control" placeholder="Maintenance Type" required>
                                </div>
                                <div class="form-group">
                                    <label>Equipment Fault <span style="color:red">*</span></label>
                                    <input type="text" name="equipmentfault" class="form-control" placeholder="Equipment Fault" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Has Corrective Maintenance done before? <span style="color:red">*</span></label>
                                    <select name="cmdonebefore" class="form-control" required>
                                        <option value="" selected="disabled">Select Answer</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Spare parts available? <span style="color:red">*</span></label>
                                    <select name="sparepartavailable" class="form-control" required>
                                        <option value="" selected="disabled">Select Answer</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Is SRE maintenance taking place in your location? <span style="color:red">*</span></label>
                                    <select name="sremaintinplace" class="form-control" required>
                                        <option value="" selected="disabled">Select Answer</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Expected Date of Maintenance <span style="color:red">*</span></label>
                                    <input type="date" name="expectedmaintdate" class="form-control" placeholder="Expected Maintenance Date" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Section 3 - Health, Safety & Environment</h4>
                                <div class="form-group">
                                    <label>Describe Location specific COVID-19 Protection Protocol <span style="color:red">*</span> </label>
                                    <textarea name="hseriskdesc" id="" cols="30" rows="1" class="form-control" required placeholder="Health, Safety & Environment Risk Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Highlight any known safety or security risks (e.g. concurrent operation, robbery prone area etc.) <span style="color:red">*</span> </label>
                                    <textarea name="secriskdesc" id="" cols="30" rows="1" class="form-control" required placeholder="Security Risk Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Describe security arrangements for CNA Staff <span style="color:red">*</span> </label>
                                    <textarea name="secarrangementdesc" id="" cols="30" rows="3" class="form-control" required placeholder="Security Arrangement Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Section 4 - Further Information</h4>
                                <div class="form-group">
                                    <label>Additional Information <span style="color:red">*</span> </label>
                                    <textarea name="moreinfo" id="" cols="30" rows="1" class="form-control" required placeholder="Additional Information"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="covidppe" class="form-class" value="COVID-19 PPE">  COVID-19 PPE
                                    &nbsp;
                                    <input type="checkbox" name="accomodation" class="form-class" value="Decent Accomodation">  Decent Accomodation
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="safetyoflocation" class="form-class" value="Safety of Location (Location Risk Assessment & Control Measures)">  Safety of Location (Location Risk Assessment & Control Measures)
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="armedsecurity" class="form-class" value="Security (Armed Escort & Protection)">  Security (Armed Escort & Protection)
                                &nbsp;
                                <input type="checkbox" name="transportation" class="form-class" value="Transportation (Equipment & Personnel)">  Transportation (Equipment & Personnel)
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="communiservice" class="form-class" value="Communication (Radios, Pagers etc)">  Communication (Radios, Pagers etc)
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="incidentsiteaccess" class="form-class" value="Access to/fro incident site (Boats, Vessel, Hovercraft etc)">  Access to/fro incident site (Boats, Vessel, Hovercraft etc)
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="medicalservices" class="form-class" value="On-site Medical services (First aid, Medic etc)">  On-site Medical services (First aid, Medic etc)
                                &nbsp;
                                <input type="checkbox" name="welfare" class="form-class" value="Welfare (Food, Water, Snacks etc)">  Welfare (Food, Water, Snacks etc)
                                </div>
                                <div class="form-group">
                                <input type="checkbox" name="safetycriticaldevice" class="form-class" value="Provision of safety critical devices. Intrinsically safe cameras, gas testers etc.">  Provision of safety critical devices. Intrinsically safe cameras, gas testers etc.
                                </div>
                                                                
                            </div>
                        </div>
                        
                        <p>
                            <a href="{{ route('maintenancerequest.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </p>   
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