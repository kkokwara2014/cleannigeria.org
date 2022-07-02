@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.messages.success')

                        <form action="{{ route('supplier.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Company Name *</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" placeholder="Supplier Name" autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('name','Enter Supplier Name') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" placeholder="Email Address" autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('email','Enter Email Address') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Phone *</label>
                                <input type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    name="phone" value="{{ old('phone') }}" placeholder="Phone Number" autofocus
                                    pattern="[0-9]+" maxlength="11">

                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <span style="color: red">{{ $errors->first('phone','Enter Phone Number') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" id="" cols="30" rows="3"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    value="{{ old('address') }}" placeholder="Company Address">

                                </textarea>

                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <span
                                        style="color: red">{{ $errors->first('address','Enter Company Address') }}</span>
                                </span>
                                @endif
                            </div>

                            <button type="reset" class="btn btn-default btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{$supplier->name}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->address}}</td>
                                    {{-- <td>
                                        @if ($supplier->isapproved==1)
                                        <span class="badge badge-success badge-pill"
                                            style="background-color: green; color:seashell"> Approved</span>
                                        @else
                                        <span class="badge badge-danger badge-pill"
                                            style="background-color: crimson; color:seashell"> Not Approved</span>

                                        @endif
                                    </td> --}}
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                {{-- @if (Auth::user()->role->id==1 || Auth::user()->role->id==2)

                                        @if ($supplier->isapproved==0)
                                        <form id="approve-{{$supplier->id}}" style="display: none"
                                                action="{{ route('supplier.approve',$supplier->id) }}"
                                                method="post">
                                                @csrf

                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                            if (confirm('Approve this?')) {
                                                                event.preventDefault();
                                                            document.getElementById('approve-{{$supplier->id}}').submit();
                                                            } else {
                                                                event.preventDefault();
                                                            }
                                                        "><span class="fa fa-check-circle-o"></span>
                                                        Approve
                                                    </a>
                                                </li>
                                                @endif
                                                @endif --}}

                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('supplier.edit',$supplier->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> </li>

                                                <form id="remove-{{$supplier->id}}" style="display: none"
                                                    action="{{ route('supplier.destroy',$supplier->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$supplier->id}}').submit();
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
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>
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