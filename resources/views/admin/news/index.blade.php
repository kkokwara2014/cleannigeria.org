@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        {{-- <a href="{{ route('news.create') }}" class="btn btn-success btn-sm"><span
            class="fa fa-user"></span> Add Key Personnel</a>
        <br><br> --}}

        <div class="row">
            <div class="col-md-7">

                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $nw)
                                <tr>
                                    <td>
                                        <img src="{{url('news_images',$nw->image)}}" alt=""
                                    class="img-responsive img-rounded" width="40" height="40">
                                    </td>
                                    <td>{{$nw->title}}</td>


                                    <td>
                                        @if ($nw->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Unapproved</span>

                                        @endif
                                    </td>
                                    <td>
                                        @if ($nw->filename!='')
                                        {{-- <a href="#"> --}}
                                            <span class="fa fa-file-pdf-o fa-2x" style="color: red"></span>
                                        {{-- </a>  --}}
                                        @else
                                            None
                                        @endif
                                    </td>
                                    <td><a href="{{ route('news.show',$nw->slug) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)

                                                @if ($nw->isapproved==0)
                                                <form id="approve-{{$nw->id}}" style="display: none"
                                                    action="{{ route('news.approve',$nw->id) }}"
                                                    method="post">
                                                   @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Approve this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('approve-{{$nw->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @endif

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('news.edit',$nw->slug) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$nw->slug}}" style="display: none"
                                                    action="{{ route('news.destroy',$nw->slug) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$nw->slug}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-5">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.messages.success')

                        <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Title *</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ old('title') }}" placeholder="News Title"
                                    autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('title','Enter News title') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">News Category *</label>
                                <select name="newscategory_id" class="form-control" autofocus>
                                    <option selected="disabled">Select News Category</option>
                                    @foreach ($newscategories as $newscat)
                                    <option value="{{$newscat->id}}">{{$newscat->name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Body</label>
                                <textarea name="body" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                    placeholder="body">
                                                        </textarea>
                                @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('body','Enter News Content') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Select Image *</label>
                                <input type="file" name="image" required>
                            </div>
                            <div class="form-group">
                                <label for="">Select File for Attachment</label>
                                <input type="file" name="filename">
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <button type="reset" class="btn btn-default btn-sm">Cancel</button>
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
