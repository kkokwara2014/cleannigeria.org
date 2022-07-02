@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        <div class="row">
            <div class="col-md-7">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('news.update',$news->slug) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="">Title <strong style="color: red">*</strong></label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ $news->title }}" placeholder="News Title" autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('title','Enter News title') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">News Category <strong style="color: red">*</strong></label>
                                <select name="newscategory_id" class="form-control" autofocus>
                                    <option selected="disabled">Select News Category</option>
                                    @foreach ($newscategories as $newscat)
                                    <option value="{{$newscat->id}}"
                                        {{ $newscat->id== $news->newscategory_id?'selected':'' }}>{{$newscat->name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Body <strong style="color: red">*</strong></label>
                                <textarea name="body" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                    placeholder="body">
                                {{ $news->body }}
                                </textarea>
                                @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('body','Enter News Content') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="">Select Image</label>
                                        <input type="file" name="image">
                                        <input type="hidden" name="news_image" value="{{$news->image}}">
                                    </div>
                                    <div class="col-md-5">
                                        Existing image :
                                        <img src="{{url('news_images',$news->image)}}" alt=""
                                            class="img-responsive img-circle" width="70" height="70">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="">Select File</label>
                                        <input type="file" name="filename">
                                        <input type="hidden" name="news_file" value="{{$news->filename}}">
                                    </div>
                                    <div class="col-md-5">
                                        Existing File :
                                        <p></p>
                                        @if ($news->filename!='')
                                        <span class="fa fa-file-pdf-o fa-2x" style="color: red"></span>
                                        {{ $news->filename }}
                                        @else
                                        No file was uploaded.
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('news.index') }}" class="btn btn-default btn-sm">Cancel</a>

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