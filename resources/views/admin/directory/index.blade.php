@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">


                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">

                            {{ $directories->links() }}

                            @foreach ($directories->chunk(4) as $chunk)
                                @foreach ($chunk as $directory)
                                    <div class="col-sm-3">

                                                    <div class="thumbnail">
                                                        <img src="{{url('user_images',$directory->userimage)}}"
                                                            alt="{{ $directory->lastname }}" class="img-responsive img-circle" width="170px" height="170px">
                                                            <hr>

                                                                    <h4><strong>{{ $directory->firstname.' '.$directory->lastname }}</strong>
                                                                    </h4>
                                                                    {{-- <div>
                                                                        <small><span class="fa fa-briefcase"></span>
                                                                            {{ $directory->role->name }}</small>
                                                                    </div> --}}
                                                                    <div>
                                                                        <small><span class="fa fa-th"></span>
                                                                            {{ $directory->staffcategory->name }}</small>
                                                                    </div>
                                                                    <div>
                                                                        <small><span class="fa fa-phone"></span> {{ $directory->phone }}</small>
                                                                    </div>
                                                                    <div>
                                                                        <small><span class="fa fa-envelope"></span> {{ $directory->email }}</small>
                                                                    </div>
                                                                    <div>
                                                                        <small><span class="fa fa-map-marker"></span>
                                                                            {{ $directory->location->name }}</small>
                                                                    </div>


                                                    </div>

                                    </div>
                                @endforeach
                            @endforeach

                            {{ $directories->links() }}

                        </div>

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
