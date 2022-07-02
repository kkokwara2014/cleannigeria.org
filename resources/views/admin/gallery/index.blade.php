@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        {{-- <a href="{{ route('gallery.create') }}" class="btn btn-success btn-sm"><span class="fa fa-user"></span> Add
        Key Personnel</a>
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

                                    <th>Created By</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                <tr>
                                    <td>
                                        <img src="{{url('images/gallery',$gallery->image)}}" alt=""
                                            class="img-responsive img-rounded" width="40" height="40">
                                    </td>
                                    <td>{{$gallery->title}}</td>


                                    <td>
                                        {{$gallery->user->firstname.' '.$gallery->user->lastname}}
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.show',$gallery->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a>
                                    </td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">



                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('gallery.edit',$gallery->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$gallery->id}}" style="display: none"
                                                    action="{{ route('gallery.destroy',$gallery->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$gallery->id}}').submit();
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

                                    <th>Created By</th>
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

                        <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Title *</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ old('title') }}" placeholder="Gallery Title" autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('title','Enter Gallery title') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="Description">
                                                        </textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('description','Enter Description') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Select Image *</label>
                                <input type="file" name="image" required>
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
