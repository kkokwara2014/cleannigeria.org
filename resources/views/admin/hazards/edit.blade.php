@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        <div class="row">
            <div class="col-md-10">

                <p>
                    <a href="{{route('hazardreports.index')}}" class="btn btn-primary btn-sm">All Hazard Reports</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{route('hazardreports.update',$hreport->id)}}" method="POST">
                            @csrf
                            @method('put')
                           
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="unsafeact" value="{{ $hreport->unsafeact }}" 
                                            @if ($hreport->unsafeact=='Unsafe')
                                                checked
                                            @endif
                                            > Unsafe Act
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="unsafecondition" value="{{ $hreport->unsafecondition}}" 
                                            @if ($hreport->unsafecondition=='Unsafe Condition')
                                                checked
                                            @endif
                                            > Unsafe Condition
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="nearmiss" value="{{ $hreport->nearmiss}}" 
                                            @if ($hreport->nearmiss=='Near Miss')
                                                checked
                                            @endif
                                            > Near Miss
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="gp" value="{{ $hreport->gp}}" 
                                            @if ($hreport->gp=='Good Practice')
                                                checked
                                            @endif
                                            > Good Practice
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Incident Description <strong style="color: red">*</strong></label>
                                        <textarea name="description" class="form-control" rows="3"
                                            placeholder="Brief Description of Observation" required maxlength="300">
                                        {{ $hreport->description }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Corrective Action <strong style="color: red">*</strong></label>
                                        <textarea name="correctiveaction" class="form-control" rows="3"
                                            placeholder="Immediate Corrective Action" required maxlength="300">
                                        {{ $hreport->correctiveaction }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Further Action <strong style="color: red">*</strong></label>
                                        <textarea name="furtheraction" class="form-control" rows="3"
                                            placeholder="Further Action to Prevent Recurrence" required maxlength="300">
                                        {{ $hreport->furtheraction }}
                                        </textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="radio">
                                        Risk Category: &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="{{ $hreport->riskcategory }}" 
                                            @if ($hreport->riskcategory=='High')
                                                checked
                                            @endif
                                            > High
                                        </label>&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="{{ $hreport->riskcategory }}" 
                                            @if ($hreport->riskcategory=='Medium')
                                                checked
                                            @endif
                                            > Medium
                                        </label>&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="{{ $hreport->riskcategory }}" 
                                            @if ($hreport->riskcategory=='Low')
                                                checked
                                            @endif
                                            > Low
                                        </label>
                                    </div>
                                    <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Date of Occurence <strong style="color: red">*</strong></label>
                                            <input name="dateofoccurence" type="text" id="datepicker2" class="form-control" placeholder="Date of Occurence" required value="{{ $hreport->dateofoccurence }}"> 
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label>Time of Occurence <strong style="color: red">*</strong></label>
                                            <input type="text" class="form-control timepicker" name="timeofoccurence" required value="{{ $hreport->timeofoccurence }}">
                                        </div>
                                        </div>
                                    </div>
                                        
                                    </div>
                                    <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Date of Reporting <strong style="color: red">*</strong></label>
                                            <input name="dateofreporting" type="text" id="datepicker3" class="form-control" placeholder="Date of Reporting" required value="{{ $hreport->dateofreporting }}"> 
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time of Reporting <strong style="color: red">*</strong></label>
                                            <input type="text" class="form-control timepicker1" name="timeofreporting" required>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group"> 
                                                                            
                                        <div class="form-group">
                                        <label>Observed By</label>
                                            <input type="text" class="form-control" value="{{auth()->user()->firstname.' '.auth()->user()->lastname.' ['.auth()->user()->email.']'}}" readonly> 
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="">Location <strong style="color: red">*</strong></label>
                                        <select name="location_id" class="form-control" required>
                                            <option selected="disabled">Select Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->id}}" {{ $location->id== $hreport->location_id?'selected':'' }}>
                                                {{$location->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Responsible Party <strong style="color: red">*</strong></label>
                                        <select name="sentto_id" class="form-control" required>
                                            <option selected="disabled">Select Responsible Party</option>
                                            @foreach ($senttos as $sentto)
                                            <option value="{{$sentto->id}}" {{ $sentto->id== $hreport->sentto_id?'selected':'' }}>
                                                {{$sentto->email.' ['.$sentto->firstname.' '.$sentto->lastname.' ]'}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                        
                                    </div>


                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Send</button>
                            <a href="{{route('hazardreports.index')}}" class="btn btn-danger btn-sm">Cancel</a>
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