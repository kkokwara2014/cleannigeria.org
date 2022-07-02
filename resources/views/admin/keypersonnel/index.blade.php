@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">


        {{-- <a href="{{ route('keypersonnel.create') }}" class="btn btn-success btn-sm"><span
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
                                    <th>Full Name</th>
                                   
                                    <th>Created By</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keypersonnels as $keypersonnel)
                                <tr>
                                    <td>
                                        <img src="{{url('images/keystaff',$keypersonnel->image)}}" alt=""
                                    class="img-responsive img-rounded" width="40" height="40">
                                    </td>
                                    <td>{{$keypersonnel->fullname}}</td>

                                   
                                    <td>
                                        {{$keypersonnel->user->firstname.' '.$keypersonnel->user->lastname}}
                                    </td>
                                    <td><a href="{{ route('keypersonnel.show',$keypersonnel->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">



                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('keypersonnel.edit',$keypersonnel->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$keypersonnel->id}}" style="display: none"
                                                    action="{{ route('keypersonnel.destroy',$keypersonnel->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$keypersonnel->id}}').submit();
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
                                    <th>Full Name</th>
                                   
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

                        <form action="{{ route('keypersonnel.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                    name="fullname" value="{{ old('fullname') }}" placeholder="Personnel's Full Name"
                                    autofocus>

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
                                    <option value="{{$role->id}}">
                                        {{$role->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Citation *</label>
                                <textarea name="biography" id="" cols="30" rows="2"
                                    class="form-control{{ $errors->has('biography') ? ' is-invalid' : '' }}"
                                    placeholder="Personnel\'s Citation">
                                                        </textarea>
                                @if ($errors->has('biography'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('biography','Enter Citation') }}</span>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Select Picture *</label>
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