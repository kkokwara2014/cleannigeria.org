@extends('frontend.layout.main')

@section('title','Membership')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>
                    <p class="text-justify">
                        <strong>Membership Application Procedure:</strong><p>
                    All new and old (renewals) members shall complete the application form number <a href="{{route('downloaddoc','CNA_Membership_Application_Procedure_2017.pdf')}}"
                    download="CNA_Membership_Application_Procedure_2017.pdf" class="page-title-color" style="text-decoration: none; font-weight: bold;">CNA APPL.1</a>
                    Provide all information required on the form with necessary attachments.
                    </p>

                    <p class="text-justify">
                        <strong>New Members</strong><p>
                    <ul type="disc" style="font-size: 16px;">
                        <li class="text-justify">
                            All new members shall complete the application form <a href="{{route('downloaddoc','CNA_Membership_Form.pdf')}}"
                            download="CNA_Membership_Form.pdf" class="page-title-color" style="text-decoration: none; font-weight: bold;">CNA APPL.1</a>
                        </li>
                        <li class="text-justify">
                            All new members will be invited for a discussion with the CNA
                            Chairman or BOD as the BOD shall consider appropriate.
                            Discussion with the BOD shall take place after TECOM has completed
                            the processing of the application form and made recommendations to
                            the CNA Board of Directors (BOD).
                        </li>
                        <li class="text-justify">
                            A non-refundable application/entrance fee of ONE HUNDRED THOUSAND
                            NAIRA ONLY will be paid in bank draft addressed to Clean Nigeria
                            Associates Ltd/Gtd. The bank draft will be submitted with the
                            completed application form. This entrance fee shall be reviewed
                            every two years or at such other periods as the Board of Director (BOD)
                            may consider appropriate.
                        </li>
                        <li class="text-justify">
                            All new members shall commit in writing to be bound by all
                            regulations governing CNA and its operations and the conditions
                            of the CNA agreement and any subsequent revision thereof.
                        </li>
                        <li class="text-justify">
                            All new members shall pay a joining fee equal to its composite
                            participation percentage share of the value of the company’s
                            equipment and materials at the time its application for membership
                            is accepted (Equalization fee).
                        </li>
                    </ul>

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


