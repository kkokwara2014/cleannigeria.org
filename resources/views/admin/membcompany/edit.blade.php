@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('membcompany.index') }}" class="btn btn-success btn-sm">
            <span class="fa fa-eye"></span> All Member Companies
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('membcompany.update',$membcompany->id) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="">name *</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ $membcompany->name }}" placeholder="Company name"
                                    autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('name','Enter Company name') }}</span>
                                </span>
                                @endif
                            </div>
                            

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Select Picture *</label>
                                        <input type="file" name="image">
                                        <input type="hidden" name="membcompany_image" value="{{$membcompany->image}}">
                                    </div>
                                    <div class="col-md-4">
                                        Existing image :
                                        <img src="{{url('images/membcomp',$membcompany->image)}}" alt=""
                                            class="img-responsive img-circle" width="70" height="70">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <br>



                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('membcompany.index') }}" class="btn btn-default btn-sm">Cancel</a>

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