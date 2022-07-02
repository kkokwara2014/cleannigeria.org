@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('keypersonnel.index') }}" class="btn btn-success btn-sm">
            <span class="fa fa-eye"></span> All Key Personnel
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('keypersonnel.update',$keypersonnel->id) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                    name="fullname" value="{{ $keypersonnel->fullname }}"
                                    placeholder="Personnel's Full Name" autofocus>

                                @if ($errors->has('fullname'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('fullname','Enter Personnel\'s full name') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Position *</label>
                                <select name="role_id" class="form-control" required>
                                    <option selected="disabled">Select Position</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}"
                                        {{ $role->id== $keypersonnel->role_id?'selected':'' }}>
                                        {{$role->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Citation *</label>
                                <textarea name="biography" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('biography') ? ' is-invalid' : '' }}"
                                    placeholder="Personnel\'s Citation">{{ $keypersonnel->biography }}
                                </textarea>
                                @if ($errors->has('biography'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('biography','Enter Citation') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Select Picture *</label>
                                        <input type="file" name="image">
                                        <input type="hidden" name="keystaff_image" value="{{$keypersonnel->image}}">
                                    </div>
                                    <div class="col-md-4">
                                        Existing image :
                                        <img src="{{url('images/keystaff',$keypersonnel->image)}}" alt=""
                                            class="img-responsive img-circle" width="70" height="70">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <br>



                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('keypersonnel.index') }}" class="btn btn-default btn-sm">Cancel</a>

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