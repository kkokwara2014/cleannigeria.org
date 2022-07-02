@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('gallery.index') }}" class="btn btn-success btn-sm">
            <span class="fa fa-eye"></span> All Galleries
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('gallery.update',$gallery->id) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="">Title *</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ $gallery->title }}" placeholder="Gallery Title"
                                    autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('title','Enter Gallery title') }}</span>
                                </span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="Description">{{ $gallery->description }}
                                                        </textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('description','Enter Description') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Select Picture *</label>
                                        <input type="file" name="image">
                                        <input type="hidden" name="gallery_image" value="{{$gallery->image}}">
                                    </div>
                                    <div class="col-md-4">
                                        Existing image :
                                        <img src="{{url('images/gallery',$gallery->image)}}" alt=""
                                            class="img-responsive img-circle" width="70" height="70">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <br>



                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('gallery.index') }}" class="btn btn-default btn-sm">Cancel</a>

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