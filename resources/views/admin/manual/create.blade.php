@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
           
            <div class="col-md-8">
             <p> <a href="{{route('manuals.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-angle-double-left"></span> All Manuals</a></p>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <form action="{{ route('manuals.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Title <span style="color:red;">*</span></label>
                                <input type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ old('title') }}" placeholder="Equipment Manual Title"
                                    autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('title','Enter Equipment Manual title') }}</span>
                                </span>
                                @endif
                            </div>
                        
                            <div class="form-group">
                                <label for="">Select File <span style="color:red;">* [PDF only]</span></label>
                                <input type="file" name="filename">
                            </div>

                            <a href="{{ route('manuals.index') }}" class="btn btn-default btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
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
