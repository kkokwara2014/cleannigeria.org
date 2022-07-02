@extends('admin.layout.app')


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
                    <a href="{{route('hazardreports.index')}}" class="btn btn-primary btn-sm">All Hazard Reports</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{route('hazardreports.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="unsafeact" value="Unsafe"> Unsafe Act
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="unsafecondition" value="Unsafe Condition" > Unsafe Condition
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="nearmiss" value="Near Miss" > Near Miss
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="checkbox" name="gp" value="Good Practice" > Good Practice
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Incident Description <strong style="color: red">*</strong></label>
                                        <textarea name="description" class="form-control" rows="3"
                                            placeholder="Brief Description of Observation" required maxlength="300"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Corrective Action <strong style="color: red">*</strong></label>
                                        <textarea name="correctiveaction" class="form-control" rows="3"
                                            placeholder="Immediate Corrective Action" required maxlength="300"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Further Action <strong style="color: red">*</strong></label>
                                        <textarea name="furtheraction" class="form-control" rows="3"
                                            placeholder="Further Action to Prevent Recurrence" required maxlength="300"></textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="radio">
                                        Risk Category: &nbsp;
                                        &nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="High" required> High
                                        </label>&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="Medium"> Medium
                                        </label>&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="riskcategory" value="Low"> Low
                                        </label>
                                    </div>
                                    <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Date of Occurence <strong style="color: red">*</strong></label>
                                            <input name="dateofoccurence" type="text" id="datepicker2" class="form-control" placeholder="Date of Occurence" required> 
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label>Time of Occurence <strong style="color: red">*</strong></label>
                                            <input type="text" class="form-control timepicker" name="timeofoccurence" required>
                                        </div>
                                        </div>
                                    </div>
                                        
                                    </div>
                                    <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Date of Reporting <strong style="color: red">*</strong></label>
                                            <input name="dateofreporting" type="text" id="datepicker3" class="form-control" placeholder="Date of Reporting" required> 
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
                                            <option value="{{$location->id}}">
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
                                            <option value="{{$sentto->id}}">
                                                {{$sentto->email.' ['.$sentto->firstname.' '.$sentto->lastname.' ]'}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                        
                                    </div>

                                </div>

                            </div>
                            <a href="{{route('hazardreports.index')}}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Send</button>
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