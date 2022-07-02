@extends('admin.layout.app')

@section('title')
    Document Details
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('documentregisters.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <p>
                                    <h3>{{$masterdocum->doctitle}}</h3>
                                </p>
                                <hr>
                                <div>Document Number : {{ $masterdocum->docnumber }} </div>
                                <div>Date Prepared : {{ $masterdocum->dateprepared }} </div>
                                <div>Revision Status : {{ $masterdocum->revisionstatus }} </div>
                                @if ($masterdocum->description!='')
                                <div>Description : {{ $masterdocum->description }} </div>                                      
                                @endif
                                <hr>
                                <div>
                                    @if ($masterdocum->filename!='')
                                         
                                       
                                        <a target="_blank" href="{{ route('viewmasterdocregister',$masterdocum->filename) }}">
                                            <span class="fa fa-file-pdf-o fa-2x text-primary text-danger"></span>
                                            &nbsp;
                                            Click to view browser
                                        </a>
                                    @endif
                                </div>
                                <br>
                                <div>Created by : 
                                    <div>
                                        <span class="fa fa-user"></span> {{ $masterdocum->user->firstname .' '.strtoupper($masterdocum->user->lastname) }} 
                                    </div>
                                    <div>
                                        <span class="fa fa-envelope"></span> {{ $masterdocum->user->email }} 
                                    </div>
                                    <div>
                                        <span class="fa fa-phone"></span> {{ $masterdocum->user->phone }} 
                                    </div>
                                </div>
                               
                            </div>


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
