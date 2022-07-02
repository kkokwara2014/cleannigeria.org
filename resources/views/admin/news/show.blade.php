@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('news.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="{{url('news_images',$nws->image)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250">

                            </div>


                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-7">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ $nws->title }}</h3>
                                <small><span class="fa fa-user"></span> {{ $nws->user->firstname.' '.$nws->user->lastname }} | </small>
                                <small><span class="fa fa-calendar"></span> {{ date('D j M, Y',strtotime($nws->created_at)) }}</small>
                                 
                                &nbsp;&nbsp;&nbsp;
                                @if ($nws->filename!='')
                                <a target="_blank" href="{{asset('storage/news_files/'. $nws->filename )}}>
                                    <span class="fa fa-download fa-2x" style="color: green"></span>
                                    <span class="fa fa-file-pdf-o fa-2x" style="color: red"></span>
                                    </a>
                                @endif
                                <hr>
                                <div>
                                <p>
                                    {{ $nws->body }}
                                </p>
                                </div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
        
        <div class="row">
            <div class="col-md-5">
                @if ($nws->filename!='')
                <iframe src="{{ asset('storage/news_files/'. $nws->filename) }}" frameborder="0" style="width:100%;min-height:590px;"></iframe>
                @endif
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
