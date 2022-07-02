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
                        
                        <form action="{{ route('manuals.update',$manual->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label for="">Title <span style="color:red;">*</span></label>
                                <input type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ $manual->title }}" placeholder="Equipment Manual Title"
                                    autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('title','Enter Equipment Manual title') }}</span>
                                </span>
                                @endif
                            </div>
                        
                            <div class="form-group">
                                
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="">Select File <span style="color:red;">* [PDF only]</span></label>
                                        <input type="file" name="filename">
                                        <input type="hidden" name="manual_file" value="{{$manual->filename}}">
                                    </div>
                                    <div class="col-md-5">
                                        Existing File :
                                        <p></p>
                                        @if ($manual->filename!='')
                                        <span class="fa fa-file-pdf-o fa-2x" style="color: red"></span>
                                        {{ $manual->filename }}
                                        @else
                                        No file was uploaded.
                                        @endif
                                    </div>
                                </div>
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
