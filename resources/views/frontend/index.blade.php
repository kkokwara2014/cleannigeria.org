@extends('frontend.layout.main')

@section('title','Home')

@section('content')

<div class="container" style="background-color: #fff;">

    <div class="head-padding">
        <section>
            <div class="row">
                <div class="col-md-9">

                    <h2 class="page-title-color">Welcome to Clean Nigeria Associates Ltd/GTE</h2>

                    <p class="text-justify">
                        The Clean Nigeria Associates (CNA), a non-profit Organization and a co-operative of several oil producing companies in Nigeria.
                        {{-- The Clean Nigeria Associates (CNA), a non-profit Organization and a
                        co-operative of currently fifteen oil producing companies in
                        Nigeria was formed in November 1981 due to increasing
                        awareness in the need to have a better and cleaner environment. --}}
                    </p>
                    <p class="text-justify">
                        The objective of the company is to promote the science of protecting, preserving, restoring the environment after oil spill and be a leading provider of human capacity development.
                        {{-- The objectives of the company are to promote the science of
                        protecting, preserving and restoring the environment after
                        oil spills.
                        To achieve this objective the company is required amongst others. --}}
                    </p>


                    <div class="row">

                        <div class="col-sm-12">
                            <div class="panel panel-heading-color">
                                <div class="panel-body panel-body-bg">
                                    <div class="col-sm-6">
                                        <h3 class="page-title-color">Our Mission</h3>

                                        @if (strlen(strip_tags($ourmission))>100)
                                        <p class="text-justify">
                                            {{ Str::limit($ourmission,208) }}
                                            <a class="badge badge-pill" style="background-color: #398439; color: #fff;"
                                                href="#" data-toggle="modal" data-target="#modal-default-mission">Read
                                                more</a>
                                        </p>

                                        @endif

                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="page-title-color">Our Vision</h3>

                                        @if (strlen(strip_tags($ourvision))>100)
                                        <p class="text-justify">
                                            {{ Str::limit($ourvision,89) }}
                                            <a class="badge badge-pill" style="background-color: #398439; color: #fff;"
                                                href="#" data-toggle="modal" data-target="#modal-default-vision">Read
                                                more</a>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-heading-color">
                                <div class="panel-body panel-body-bg">
                                    <div class="col-sm-6">

                                        <h3 class="page-title-color">GM's Statement</h3>


                                        @if (strlen(strip_tags($gmstatement))>100)
                                        <p class="text-justify">
                                            {{ Str::limit($gmstatement,401) }}
                                            <a class="badge badge-pill" style="background-color: #398439; color: #fff;"
                                                href="#" data-toggle="modal"
                                                data-target="#modal-default-gmstatement">Read more</a>
                                        </p>
                                        @endif


                                    </div>

                                    <div class="col-sm-6">

                                        <h3 class="page-title-color">Key Personnel</h3>
                                        <p class="text-justify">
                                            <table style="border: 0" class="table-responsive">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="{{ route('keystaff') }}" class="h-link-color"
                                                                style="text-decoration: none; font-size: 14px;"><span
                                                                    class="fa fa-user fa-2x text-success"></span>
                                                                General Manager</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <a href="{{ route('keystaff') }}" class="h-link-color"
                                                                style="text-decoration: none; font-size: 14px;"><span
                                                                    class="fa fa-user fa-2x text-success"></span>
                                                                Admin/Accounts Manager</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <a href="{{ route('keystaff') }}" class="h-link-color"
                                                                style="text-decoration: none; font-size: 14px;"><span
                                                                    class="fa fa-user fa-2x text-success"></span> Base
                                                                Superintendent East</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <a href="{{ route('keystaff') }}" class="h-link-color"
                                                                style="text-decoration: none; font-size: 14px;"><span
                                                                    class="fa fa-user fa-2x text-success"></span> Base
                                                                Superintendent West</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-heading-color">
                                <div class="panel-body panel-body-bg">
                                    <div class="col-sm-12">
                                        <h3 class="page-title-color">CNA News</h3>
                                        @foreach ($news as $nw)
                                        <h4 class="page-title-color">
                                                <a href="{{ route('news_show',$nw->slug) }}" style="text-decoration: none;">
                                                    {{ $nw->title }}         
                                                </a>

                                                &nbsp;
                                                <a href="{{ route('socialshare',$nw->slug) }}" target="_blank"><span class="fa fa-share-alt"></span></a>

                                            </h4>

                                        
                                        <small>
                                            <img src="{{url('user_images',$nw->user->userimage)}}"
                                                class="img-responsive img-rounded" width="30" height="30"
                                                style="border-radius: 50%" align="left" /> &nbsp;
                                            Published {{ $nw->created_at->diffForHumans() }} on
                                            {{ date('D j M, Y',strtotime($nw->created_at)) }}
                                            &nbsp; by
                                            <strong>{{ $nw->user->firstname.' '.$nw->user->lastname }}</strong>
                                        </small>
                                        <hr>

                                        @endforeach




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-heading-color">
                                <div class="panel-body panel-body-bg">
                                    <div class="col-sm-12">

                                        <h4 class="page-title-color" style="color:red;">FOR OIL SPILL EMERGENCY, CALL
                                            THE DUTY COORDINATOR ON
                                            0906-287-3290</h4>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>


                    <br><br>
                </div>

                <div class="col-md-3 text-justify">
                    @include('frontend.layout.sidebar')
                </div>
            </div>

        </section>
    </div>



    {{-- modal for our mission --}}
<div class="modal fade" id="modal-default-mission">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Our Mission</h4>
            </div>
            <div class="modal-body" style="text-align: justify">

                {{ $ourmission }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{-- modal for our vision --}}
<div class="modal fade" id="modal-default-vision">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Our Vision</h4>
            </div>
            <div class="modal-body" style="text-align: justify">

                {{ $ourvision }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{-- modal for our gmstatement --}}
<div class="modal fade" id="modal-default-gmstatement">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">GM's Statement</h4>
            </div>
            <div class="modal-body" style="text-align: justify">
               {{ $gmstatement }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>



@endsection
