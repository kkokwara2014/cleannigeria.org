@extends('frontend.layout.main')

@section('title','Our Services')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">

                        CNA has been engaged in various spill response activities over
                        the years. From 1989 till date she had responded to (well) over a hundred spills
                        of various magnitudes and in diverse terrain covering offshore,
                        inland, land, swamp etc. During oil spill containment and cleanup
                        operations, CNA functions under the sole direction and control of
                        the member company requesting the assistance, providing specialist
                        advice and full response activities. Request for CNA assistance
                        is made directly to CNA management who then mobilizes its personnel
                        to the site and subsequently report its operational activities to
                        the Board of Directors (B.O.D).
                    </p>

                    <hr>
                    <div class="row">

                        @forelse ($services->chunk(4) as $chunk)

                                    @foreach ($chunk as $service)

                        <div class="col-sm-6">
                            <div class="thumbnail">
                                <img width="350" height="450" src="{{url('images/services',$service->image)}}" class="img-responsive img-rounded services-images">
                            </div>
                            <div class="caption">
                                <h4><strong>{{ $service->title }}</strong></h4>
                                <blockquote>
                                    <small>
                                        <i>
                                            {{ $service->description }}
                                        </i>
                                    </small>
                                </blockquote>

                            </div>
                        </div>

                        @endforeach
                        @endforeach

                    </div>

                    {{ $services->links() }}

                </div>

                <div class="col-md-3 text-justify">
                    <div class="col-sm-12">
                        @include('frontend.layout.sidebar')
                    </div>
                </div>
            </div>
        </section>
        <br/><br/>
    </div>
</div>


@endsection


