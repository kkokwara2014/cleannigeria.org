@extends('frontend.layout.main')

@section('title','Key Staff')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        Meet some of our dynamic team members
                    </p>
                       
                                <div class="row">

                                    @forelse ($keypersonnels->chunk(4) as $chunk)

                                    @foreach ($chunk as $keystaff)
                                    <div class="col-sm-3">
                                        <div class="thumbnail">
                                            <a href="#" data-toggle="modal" data-target="#modal-{{ $keystaff->id }}">
                                                <img src="{{url('images/keystaff',$keystaff->image)}}" alt="{{ $keystaff->fullname }}"
                                                    class="img-responsive img-circle"></a>
                                        </div>
                                        <div class="caption">
                                            <h4><strong><a class="page-title-color" href="#" data-toggle="modal"
                                                        data-target="#modal-{{ $keystaff->id }}">{{ $keystaff->fullname }}</a></strong></h4>
                                            <blockquote>
                                                <small><i>{{ $keystaff->role->name }}</i></small>
                                            </blockquote>
                                            <!--<i>20 Years Experience</i>-->
                                        </div>

                                        <!--the modal for keystaff status-->
                                        <div class="modal fade" id="modal-{{ $keystaff->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog">
                                                <!--modal-sm-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><strong>{{ $keystaff->fullname }}'s Profile</strong>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img width="90" height="90" src="{{url('images/keystaff',$keystaff->image)}}"
                                                            class="img-responsive img-circle pull-left">

                                                        <p class="text-justify">
                                                            {{ $keystaff->biography }}
                                                        </p>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div>

                                        </div>

                                    </div>

                                    @endforeach
                                    @endforeach


                                    {{ $keypersonnels->links() }}

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