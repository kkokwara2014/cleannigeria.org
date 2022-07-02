@extends('frontend.layout.main')

@section('title','News')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    @foreach ($news as $nw)
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <a href="{{ route('news_show',$nw->slug) }}">
                                <h4 class="page-title-color"><strong>{{ $nw->title }} &nbsp;&nbsp;<span class="fa fa-external-link"></span></strong></h4>
                                
                            </a>

                            
                            <div>
                                <img src="{{url('user_images',$nw->user->userimage)}}"
                                    class="img-responsive img-rounded" width="50" height="50"
                                    style="border-radius: 50%" align="left"/> &nbsp;
                                Published {{ $nw->created_at->diffForHumans() }} on
                                {{ date('D j M, Y',strtotime($nw->created_at)) }}

                                &nbsp;&nbsp;&nbsp;
                                @if ($nw->filename!='')
                                <a href="{{route('download.news', $nw->filename )}}"
                                    download="{{ $nw->filename }}">
                                    <span class="fa fa-download" style="color: green"></span>
                                    <span class="fa fa-file-pdf-o" style="color: red"></span>
                                    </a>
                                @endif


                                <p>&nbsp; by <strong>{{ $nw->user->firstname.' '.$nw->user->lastname }}</strong></p>

                            </div>

                            @if (strlen(strip_tags($nw->body))>100)
                            <p class="text-justify"> 
                
                                {{ Str::limit($nw->body,200) }}
                                <a class="badge badge-pill" style="background-color: #398439; color: #fff;"
                                    href="{{ route('news_show',$nw->slug) }}">Read
                                    more</a>

                            </p>

                            @endif
                        </div>
                    </div>
                    @endforeach


                    {{ $news->links() }}
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
