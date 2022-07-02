@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('store.index') }}" class="btn btn-success btn-sm">
           <span class="fa fa-eye"></span> All Stores
        </a>
        <br><br>

        <div class="row">
            <div class="col-md-5">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.update',$stores->id) }}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div>
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$stores->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Location</label>
                                <select name="location_id" class="form-control">
                                    <option selected="disabled">Select Store Location</option>
                                    @foreach ($locations as $location)
                                    <option value="{{$location->id}}" {{$location->id==$stores->location_id ? 'selected':''}}>{{$location->name}}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('store.index') }}" class="btn btn-default btn-sm">Cancel</a>

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
