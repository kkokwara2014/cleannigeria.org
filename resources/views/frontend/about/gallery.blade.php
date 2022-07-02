@extends('frontend.layout.main')

@section('title','Equipment Gallery')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        Take a look at our OSR Equipment, training events, drills and exercises.
                    </p>

                    <div class="row">

                        @forelse ($galleries->chunk(4) as $chunk)

                        @foreach ($chunk as $gallery)
                        <div class="col-sm-3">
                            <div class="thumbnail">

                                <a href="#" data-toggle="modal" data-target="#modal-{{ $gallery->id }}" >
                                    <img src="{{url('images/gallery',$gallery->image)}}" alt="{{ $gallery->title }}" width="600px" height="600px">
                                </a>
                            </div>
                            <!--the modal for gallery status-->
                            <div class="modal fade" id="modal-{{ $gallery->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <!--modal-sm-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><strong>{{ $gallery->title }}</strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <img width="600" height="600" src="{{url('images/gallery',$gallery->image)}}" class="img-responsive img-rounded">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>

                            </div>


                        </div>

                        @endforeach
                        @endforeach


                        {{ $galleries->links() }}

                    </div>


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


