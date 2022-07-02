@extends('frontend.layout.main')

@section('title','Our Objectives')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>
                    <img style="padding-left: 15px; padding-right: 5px;" width="450" height="450" src="{{ asset('images/services/env_preserv.png') }}" class="img-responsive img-rounded pull-right">
                    <p class="text-justify">
                        The objective of the company is to promote the science of protecting,
                        preserving and restoring the environment after oil spills.
                        To achieve this objective, the company is required amongst others:
                    </p>
                    <p class="text-justify">
                    <ol type="1">
                        <li class="text-justify" style="font-size: 15px;">
                            To establish and maintain a speedy and effective response
                            capability to combat second- tier oil spills in addition
                            to any such capability maintained by any individual member.
                        </li>
                        <li class="text-justify" style="font-size: 15px;">
                            To minimize the impact of oil spills on sensitive ecosystems
                            and communities through the provision of relevant equipment and
                            the use of competent and dedicated response personnel.
                        </li>
                        {{-- <li class="text-justify" style="font-size: 15px;">
                            To provide a secondary spill response resource as a complement to
                            each member’s existing capability.
                        </li> --}}
                        <li class="text-justify" style="font-size: 15px;">
                            To provide support in combating third-tier oil spills at the request
                            of members, non-members or government agencies.
                        </li>
                        <li class="text-justify" style="font-size: 15px;">
                            To provide training programmes on, and conduct or support research into,
                            subjects pertaining to the environment.
                        </li>
                        <li class="text-justify" style="font-size: 15px;">
                            To provide waste management services in relation to oil spill clean-up activities.
                        </li>
                    </ol>

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


