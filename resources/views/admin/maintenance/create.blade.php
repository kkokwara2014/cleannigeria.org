@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        <a href="{{ route('maintenance.create') }}" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> Log Maintenance Details</a>
        <br><br>

        <div class="row">
            <div class="col-md-12">

                         <div class="box">
                             <!-- /.box-header -->
                             <div class="box-body">
                                <form action="{{ route('maintenance.store') }}" method="post">
                                     @csrf

                                     <div class="row">
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label for="">SR Equipment <strong style="color: red">*</strong></label>
                                                 <select name="srequipment_id" class="form-control" required>
                                                     <option selected="disabled">Select SR Equipment</option>
                                                     @foreach ($srequipments as $srequip)
                                                     <option value="{{$srequip->id}}">
                                                         {{$srequip->refnumb.' - '.$srequip->name}}
                                                     </option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group">
                                                 <label for="">Maintenance Cycle <strong style="color: red">*</strong></label>
                                                 <select name="maintcycle" class="form-control" required>
                                                     <option selected="disabled">Select Maintenance Cycle</option>

                                                     <option value="Weekly">Weekly</option>
                                                     <option value="Monthly">Monthly</option>
                                                     <option value="Quarterly">Quarterly</option>

                                                 </select>
                                             </div>


                                             <div class="form-group">
                                                 <label for="">Last Maintenance Date <strong style="color: red">*</strong></label>
                                                 <input id="datepicker" type="text"
                                                     class="form-control{{ $errors->has('lastmaintdate') ? ' is-invalid' : '' }}"
                                                     name="lastmaintdate" placeholder="Maintenance Date">
                                                 @if ($errors->has('lastmaintdate'))
                                                 <span class="invalid-feedback" role="alert">
                                                     <span
                                                         style="color: red">{{ $errors->first('lastmaintdate','Select maintenance date') }}</span>
                                                 </span>
                                                 @endif
                                             </div>

                                             <div class="form-group">
                                                <label for="">Next Maintenance Date <strong style="color: red">*</strong></label>
                                                <input id="datepicker1" type="text"
                                                    class="form-control{{ $errors->has('nextmaintdate') ? ' is-invalid' : '' }}"
                                                    name="nextmaintdate" placeholder="Next Maintenance Date">
                                                @if ($errors->has('nextmaintdate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <span
                                                        style="color: red">{{ $errors->first('nextmaintdate','Select Next Maintenance date') }}</span>
                                                </span>
                                                @endif
                                            </div>



                                         </div>
                                         <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="">Activity Description <strong style="color: red">*</strong></label>
                                                <textarea name="activitydescription" id="" cols="30" rows="2" class="form-control{{ $errors->has('activitydescription') ? ' is-invalid' : '' }}"
                                                    placeholder="Activity Description">
                                                                        </textarea>
                                                                        @if ($errors->has('activitydescription'))
                                                <span class="invalid-feedback" role="alert">
                                                    <span
                                                        style="color: red">{{ $errors->first('activitydescription','Enter Activity Description') }}</span>
                                                </span>
                                                @endif
                                            </div>

                                             <div class="form-group">
                                                 <label for="">Spare(s) Required (if any)</label>
                                                 <textarea name="sparesrequired" id="" cols="30" rows="5" class="form-control"
                                                     placeholder="Spare(s) Required if any">
                                                 </textarea>

                                             </div>


                                         </div>
                                     </div>

                                     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                     <br>
                                     <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                     <a href="{{ route('maintenance.index') }}" class="btn btn-default btn-sm">Cancel</a>

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
