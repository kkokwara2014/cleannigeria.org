@extends('admin.layout.app')

@section('title')
    Waybill Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('waybills.index') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-eye"></span> All Waybills
            </a>
            
            <a href="{{ route('waybills.create') }}" class="btn btn-primary btn-sm">
                <span class="fa fa-user-plus"></span> Create Waybill
            </a>

            <a style="float: right" href="{{ route('print.waybill',$waybill) }}" class="btn btn-success btn-sm btnprintway">
                <span class="fa fa-print"></span> Print Waybill
            </a>
        </p>

        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{-- <p>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-sm">Dashboard</a>
                            <a href="{{ route('waybills.create') }}" class="btn btn-secondary btn-sm">Create Waybill</a>
                        </p> --}}
                        {{-- <div class="card">
                                      
                            <div class="card-body"> --}}
                                <div>
                                    <h5>Vehicle number: {{ $waybill->vehiclenum }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            From: {{ $waybill->waybilllocation->name }}
                                        </div>
                                        <div class="col-md-6">
                                            To: {{ $waybill->destination }}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        Created on : {{ date('d M, Y.',strtotime($waybill->created_at)) }}
                                    </div>
                                    <div class="row" style="font-weight: bold">
                                        <div class="col-md-4">
                                            Creator: {{ $waybill->user->firstname.' '.$waybill->user->lastname }}
                                        </div>
                                        <div class="col-md-4">
                                            Receiver: {{ $waybill->receiver->firstname.' '.$waybill->user->lastname }}
                                        </div>
                                        <div class="col-md-4">
                                            Approver: {{ $waybill->approver->firstname.' '.$waybill->user->lastname }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-light table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($waybill->waybillitems as $waybillitem)
                                            <tr>
                                                <td>{{ $waybillitem->waybill->waybillnum }}</td>
                                                <td>{{ $waybillitem->issuenum }}</td>
                                                <td>{{ $waybillitem->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            {{-- </div> --}}
                        {{-- </div> --}}
                       
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
