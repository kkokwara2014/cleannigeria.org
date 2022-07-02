@extends('frontend.layout.main')

@section('title','Safety Policies')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">

                    </p>
                    <p>

                    </p>

                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapsehse">
                                    <h4 class="panel-title page-title-color">
                                        <strong>Health, Safety and Environment (HSE)</strong>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapsehse" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p class="text-justify">
                                        We manage Health, Safety and Environment as an integral part of our business. We are committed to:
                                    <ul type="square">
                                        <li style="font-size: 14px;" class="text-justify">Compliance with local and international Standards of industry best practices.</li>
                                        <li style="font-size: 14px;" class="text-justify">The wellbeing of our staff and contractors.</li>
                                        <li style="font-size: 14px;" class="text-justify">Assessment and mitigation of risks.</li>
                                        <li style="font-size: 14px;" class="text-justify">Maintaining healthy and sustainable Environment where we work and live.</li>
                                        <li style="font-size: 14px;" class="text-justify">Personnel ownership of Health, Safety and Environment. </li>
                                        <li style="font-size: 14px;" class="text-justify">Continual improvement of our processes.</li>
                                    </ul>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapsesmoking">
                                    <h4 class="panel-title page-title-color">
                                        <strong>Smoking</strong>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapsesmoking" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p class="text-justify">
                                        Clean Nigeria Associates Ltd/Gte recognizes that smoking is
                                        not only injurious to health, but also a potential safety and health hazard.
                                        Smoking in public places exposes Non-smokers to health-related risk.
                                    </p>
                                    <p class="text-justify">
                                        In Clean Nigeria Associates Ltd/Gte:</p>
                                    <ul type="square">
                                        <li style="font-size: 14px;" class="text-justify">Smoking of pipes or cigarettes is prohibited in all worksites and office premises.</li>
                                        <li style="font-size: 14px;" class="text-justify">Smoking of cigarettes is only allowed in designated Smoking Area(s) approved by Management.</li>
                                        <li style="font-size: 14px;" class="text-justify">Smoking of illegal substance(s) is prohibited in all worksites and facilities.</li>
                                    </ul>


                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapsealcohol">
                                    <h4 class="panel-title page-title-color">
                                        <strong>Substance Abuse</strong>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapsealcohol" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p class="text-justify">
                                        Clean Nigeria Associates Ltd/Gte defines “Substance abuse” as the intentional overindulgence or dependence on drugs and other chemical that are detrimental to the individual’s physical and mental health and impairs their ability to perform their tasks.
                                    </p>
                                    <p class="text-justify">

                                        The substances include alcohol, drugs and other substances that may alter behaviour, judgement or job performance.
                                    </p>
                                    <p class="text-justify">
                                        It is therefore our Policy to:

                                        <ul type="square">
                                            <li style="font-size: 14px;" class="text-justify">
                                                Encourage a healthy-work life balance with CNA personnel through education and awareness programmes.
                                            </li>
                                            <li style="font-size: 14px;" class="text-justify">
                                                Ensure that only competent and authorized personnel operate CNA’s equipment and vehicles.
                                            </li>
                                            <li style="font-size: 14px;" class="text-justify">
                                                Disengage any personnel becoming a risk to him/herself and other personnel by abuse of alcohol, drugs and other substance.
                                            </li>
                                            <li style="font-size: 14px;" class="text-justify">
                                                Test any CNA personnel suspected to be under the influence of alcohol, drugs and other substances while on duty.
                                            </li>

                                        </ul>
                                    </p>
                                    <p class="text-justify">
                                        All CNA personnel are responsible for making themselves fit for work.

Violation of this substance abuse policy concerning good conduct in the workplace will surely attract disciplinary action.

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </p></p>
                    <blockquote>
                        <p>
                            <strong>Cyril Ezeaku</strong>
                        </p>
                        <small><i>General Manager</i></small>
                    </blockquote>
                    <br>
                    <br>
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


