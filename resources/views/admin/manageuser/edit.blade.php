@extends('admin.layout.app')

@section('title')
Manage User
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <h3>Manage {{ $staff->firstname.' '.$staff->lastname }}</h3>

                        <form action="{{ route('manageusers.update',$staff->id) }}" method="post">
                            @csrf
                            @method('put')

                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $staff->hasAnyRole($role->name)?'checked':'' }}>
                                     <label>{{ $role->name }}</label>
                                </div>                                
                            @endforeach

                            <p>
                                <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-floppy-o"></span> Save</button>
                            </p>

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