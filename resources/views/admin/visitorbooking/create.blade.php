@extends('admin.layout.app')

@section('title')
Book Visitor
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <p>
            <a href="{{ route('visitorbookings.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> Booked Visitors
            </a>
        </p>

      

        <div class="row">
            <div class="col-md-10">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        @livewire('bookvisitor')

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

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