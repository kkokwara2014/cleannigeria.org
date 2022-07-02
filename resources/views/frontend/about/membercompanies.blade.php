@extends('frontend.layout.main')

@section('title','Member Companies')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        CNA is made up of the following companies below
                    </p>
                    <div class="row">
                        @forelse ($membcompanies->chunk(4) as $chunk)

                        @foreach ($chunk as $membcompany)
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-size-in-thumbnail" src="{{url('images/membcomp',$membcompany->image)}}" alt="{{ $membcompany->name }}">
                               
                            </div>

                        </div>

                        @endforeach
                        @endforeach  
                        

                        {{ $membcompanies->links() }}
                    </div>
                    
                    <br /><br />
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