@extends('frontend.layout.main')

@section('title','Base Operation')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        CNA Oil Spill Response Equipment (SRE) and materials are currently
                        strategically stockpiled in two main bases and four strategic
                        bases in Nigeria. The two main bases are located at the
                        Nigeria Ports Authority, in Port Harcourt and the Temile
                        Facility, Ogunu in Warri. The strategic bases are in Eket,
                        Brass, Mosimi and Kaunda.
                        The main bases became operationally effective in 1985 when most of the equipment were purchased.
                    </p>
                    <p class="text-justify">
                        CNA restructured system has the operations divided into
                        two regions manned by three different labour supply
                        contractors as follows:
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1">
                                    <h4 class="panel-title page-title-color">
                                        <strong>Eastern Operations</strong>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul type="square">
                                        <li>Eket</li>
                                        <li>Port Harcourt</li>
                                        <li>Kaduna</li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse2">
                                    <h4 class="panel-title page-title-color">
                                        <strong>Western Operations</strong>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul type="square">
                                        <li>Brass</li>
                                        <li>Mosimi</li>
                                        <li>Warri</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    </p>
                    <p><p>

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


