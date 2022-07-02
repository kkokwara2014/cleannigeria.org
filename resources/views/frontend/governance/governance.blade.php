@extends('frontend.layout.main')

@section('title','Governance')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        In order to achieve her objectives, Clean Nigeria Associates
                        Ltd/Gte is structured as shown in the Organizational Chart
                        Diagram.
                    </p>
                    <p>
                        <img class="img-responsive" src="{{ asset('bootstrap_assets/images/organogram/organogram.PNG') }}" >
                    </p>
                    <br/><br/>
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


