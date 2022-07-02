
<hr/>

<div class="panel panel-heading-color">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong class="panel-heading-text-color">CNA Menu</strong>
        </h4>
    </div>
    <div class="panel-body panel-body-bg">
        <p class="text-left">
        <table style="border: 0" class="table-responsive">
            <tbody>
                <tr>
                    <td><span class="fa fa-angle-right"></span> <a href="{{ route('index') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Home</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('baseoperation') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Base Operation</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('cnaobjectives') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">CNA Objectives</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('membercompanies') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Our Members</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('services') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Services</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('gallery') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Gallery</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('keystaff') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Key Staff</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('governance') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Governance</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('safetypolicies') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Policies</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-angle-right"></span> <a href="{{ route('contactus') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Contact Us</a></td>
                </tr>

            </tbody>
        </table>
        </p>
    </div>
</div>
<div class="panel panel-heading-color">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong class="panel-heading-text-color">Contact Us</strong>
        </h4>
    </div>
    <div class="panel-body panel-body-bg" style="font-size: 14px;">
        <div>
            <span class="fa fa-envelope-o"></span> enquiry@cleannigeria.org
        </div>
        <div>
            You can reach us by sending a message via
            our <a href="{{ route('contactus') }}">Contact Us</a> page.
        </div>
        <p></p>
        <div class="row" style="font-size:20px; text-align: center;">
            <div class="col-md-3">
                <a href="https://www.linkedin.com/in/clean-nigeria-associates/" target="_blank"><span
                    class="fa fa-linkedin-square" style="color: #398439; "></span></a>
            </div>
            <div class="col-md-3">
                <a href="https://twitter.com/cleannigeriaas1" target="_blank"><span
                    class="fa fa-twitter-square" style="color: #398439; "></span></a>
            </div>
            <div class="col-md-3">
                <a href="https://www.facebook.com/cleannigeriaassociates.cna" target="_blank"><span
                    class="fa fa-facebook-square" style="color: #398439; "></span></a>
            </div>
            <div class="col-md-3">
                <a href="https://www.instagram.com/cleannigeriaassociates/" target="_blank"><span
                    class="fa fa-instagram" style="color: #398439; "></span></a>
            </div>
        </div>

    </div>
</div>

<div class="panel panel-heading-color">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong class="panel-heading-text-color">Downloads</strong>
        </h4>
    </div>
    <div class="panel-body panel-body-bg">
        <p class="text-left">
        <table style="border:0" class="table-responsive">
            <tbody>
                {{-- <tr>
                    <td><a href="{{route('downloaddoc','CNA_MEMART.pdf')}}"
                        download="CNA_MEMART.pdf" class="h-link-color" style="text-decoration: none; font-size: 14px;"><span class="fa fa-download text-success"></span> Memo. &AMP; Art of Association</a></td>
                </tr> --}}
                <tr>
                    <td> <a href="{{route('downloaddoc','CNA_Membership_Application_Procedure_2017.pdf')}}"
                        download="CNA_Membership_Application_Procedure_2017.pdf"
                         class="h-link-color" style="text-decoration: none; font-size: 14px;"><span class="fa fa-download text-success"></span> Membership Application</a></td>
                </tr>
                <tr>
                    <td> <a href="{{route('downloaddoc','CNA_Membership_Form.pdf')}}"
                        download="CNA_Membership_Form.pdf" class="h-link-color" style="text-decoration: none; font-size: 14px;"><span class="fa fa-download text-success"></span> Aplication Form</a></td>
                </tr>
                {{-- <tr>
                    <td><a href="{{route('downloaddoc','CNA_Notification_Form.docx')}}"
                        download="CNA_Notification_Form.docx" class="h-link-color" style="text-decoration: none; font-size: 14px;"><span class="fa fa-download text-success"></span> Notification Form</a></td>
                </tr> --}}
                <tr>
                    <td> <a href="{{route('downloaddoc','CNA_THIRD_PARTY_AGREEMENT_2018.pdf')}}"
                        download="CNA_THIRD_PARTY_AGREEMENT_2018.pdf"
                        class="h-link-color" style="text-decoration: none; font-size: 14px;"><span class="fa fa-download text-success"></span> Third Party Agreement</a></td>
                </tr>
            </tbody>
        </table>
        </p>
    </div>


</div>

{{-- <div class="panel panel-heading-color">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong class="panel-heading-text-color">Key Personnel</strong>
        </h4>
    </div>
    <div class="panel-body panel-body-bg">
        <p class="text-left">
        <table style="border: 0" class="table-responsive">
            <tbody>
                <tr>
                    <td><span class="fa fa-user text-success"></span> <a href="" class="h-link-color" style="text-decoration: none; font-size: 14px;">General Manager</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-user text-success"></span> <a href="{{ route('keystaff') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Admin/Accounts Manager</a></td>
                </tr>
                <tr>
                    <td><span class="fa fa-user text-success"></span> <a href="{{ route('keystaff') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Base Superintendent East</a></td>
                </tr>
                <tr>
                    <td> <span class="fa fa-user text-success"></span> <a href="{{ route('keystaff') }}" class="h-link-color" style="text-decoration: none; font-size: 14px;">Base Superintendent West</a></td>
                </tr>
            </tbody>
        </table>
        </p>
    </div>
</div> --}}
<br/><br/>
