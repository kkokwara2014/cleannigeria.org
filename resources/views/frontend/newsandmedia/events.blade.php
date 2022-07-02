@extends('frontend.layout.main')

@section('title','Events')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>


                    <p class="text-justify">
                       <i class="">Coming soon!</i>
                    </p>


                </p></p>

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


