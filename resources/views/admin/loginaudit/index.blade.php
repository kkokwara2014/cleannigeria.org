@extends('admin.layout.app')

@section('title')
 Login Trails
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        
        <div class="row">
            <div class="col-md-12">

                {{--  @include('admin.messages.success')
                @include('admin.messages.deleted')  --}}

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>IP Address</th>
                                <th>Device</th>
                                <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logins as $login)
                                <tr>
                                     <td>{{  $login->user->firstname.' '.$login->user->lastname  }}</td>
                                    <td>{{  $login->ipaddress  }}</td>
                                    <td>{{  $login->device  }}</td>
                                    <td>{{  $login->created_at  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
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
