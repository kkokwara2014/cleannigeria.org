@extends('frontend.layout.main')

@section('title','News Detail')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>
                    <a href="{{ route('news') }}" class="btn btn-success btn-sm"><span
                            class="fa fa-arrow-circle-left"></span> Back to News</a>
                    <a href="{{ route('index') }}" class="btn btn-success btn-sm"><span class="fa fa-home"></span> Back
                        to Home</a>

                    <h4 class="page-title-color">{{ $nw->title }}</h4>
                    <div>
                        <img src="{{url('user_images',$nw->user->userimage)}}" class="img-responsive img-rounded"
                            width="50" height="50" style="border-radius: 50%" align="left">
                        &nbsp; Published {{ $nw->created_at->diffForHumans() }} on
                        {{ date('D j M, Y',strtotime($nw->created_at)) }}

                        &nbsp;&nbsp;&nbsp;
                        @if ($nw->filename!='')
                        <a href="{{route('download.news', $nw->filename )}}" download="{{ $nw->filename }}">
                            <span class="fa fa-download" style="color: green"></span>
                            <span class="fa fa-file-pdf-o" style="color: red"></span>
                        </a>
                        @endif

                        <p>&nbsp; by <strong>{{ $nw->user->firstname.' '.$nw->user->lastname }}</strong></p>
                    </div>

                    <img src="{{url('news_images',$nw->image)}}" class="img-responsive img-rounded"
                        style="border-radius: 10px; margin-left: 15px; width: 420px; height: 260;" align="right">

                    <p class="text-justify">
                        {{ $nw->body }}
                    </p>

                    <p>
                        <strong>{{ $nw->user->firstname.' '.$nw->user->lastname }}</strong>
                        <blockquote>
                            <small><i>Editor-in-Chief</i></small>
                        </blockquote>
                    </p>








                    <br><br>
                </div>

                <div class="col-md-3 text-justify">
                    <div class="col-sm-12">
                        @include('frontend.layout.sidebar')
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>


@endsection