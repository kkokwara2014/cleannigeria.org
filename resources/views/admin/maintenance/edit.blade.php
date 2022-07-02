@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('maintenance.index') }}" class="btn btn-success btn-sm">
           <span class="fa fa-eye"></span> All Maintenances
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-10">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('maintenance.update',$maint->id) }}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">SR Equipment <strong style="color: red">*</strong></label>
                                        <select name="srequipment_id" class="form-control" required>
                                            <option selected="disabled">Select SR Equipment</option>
                                            @foreach ($srequipments as $srequip)
                                            <option value="{{$srequip->id}}" {{ $srequip->id==$maint->srequipment_id?'selected':'' }}>
                                                {{$srequip->refnumb.' - '.$srequip->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Maintenance Cycle <strong style="color: red">*</strong></label>
                                        <select name="maintcycle" class="form-control" required>
                                            <option selected="disabled">Select Maintenance Cycle</option>

                                            <option value="Weekly" {{ $maint->maintcycle=='Weekly'?'selected':'' }}>Weekly</option>
                                            <option value="Monthly" {{ $maint->maintcycle=='Monthly'?'selected':'' }}>Monthly</option>
                                            <option value="Quarterly" {{ $maint->maintcycle=='Quarterly'?'selected':'' }}>Quarterly</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Last Maintenance Date <strong style="color: red">*</strong></label>
                                        <input id="datepicker" type="text"
                                            class="form-control{{ $errors->has('lastmaintdate') ? ' is-invalid' : '' }}"
                                            name="lastmaintdate" placeholder="Maintenance Date" value="{{ $maint->lastmaintdate }}">
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
                                           name="nextmaintdate" placeholder="Next Maintenance Date" value="{{ $maint->nextmaintdate }}">
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
                                            {{ $maint->activitydescription }}
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
                                             {{ $maint->sparesrequired }}
                                         </textarea>

                                     </div>

                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('maintenance.index') }}" class="btn btn-default btn-sm">Cancel</a>

                    </div>
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
