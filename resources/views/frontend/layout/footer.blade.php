
<!--the modal for Activating CNA status-->
<div class="modal fade" id="activateCNAModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!--modal-sm-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Activate CNA</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                In the event of a spill, call our 24-hour emergency line.
                <p>
                <div>Your name and contact details.</div>
                <div>Company/ship name.</div>
                <div>Type of product spilled.</div>
                <div>Location of incident.</div>
                <div>Approximate quantity spilled.</div>
                <div>Is the source ongoing?</div>
                </p>
                Are there any relevant safety issues?
                <hr/>
                <strong>Emergency Contact Number</strong>
                <div> +234 814 302 8445 </div>
                <hr/>
                <p>You can fill an online mobilization request form <a href="mobreqform">here</a></p>
                <strong>Email</strong>
                <div>response@cleannigeria.org</div>
                <hr/>
                <p class="text-justify">
                    <b style="color: #ff0000;">
                        <i>
                            Please note:
                            Response services are guaranteed ONLY for members.
                            Non-members will be required to sign a third-party
                            agreement before a response is initiated.
                            A work order will need to be completed before
                            responders arrive and begin a response.
                        </i>
                    </b>
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div>

</div>

</div>
<!-- Footer -->
<footer class="bg3 footer" style="bottom: 0;">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 text-center">
                <!--                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    Useful Links
                                    <ul type="square">
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Base Operations</a></li>
                                        <li><a href="#">Member Companies</a></li>
                                        <li><a href="#">CNA Objectives</a></li>
                                        <li><a href="#">Membership</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Gallery</a></li>
                                    </ul>

                                </div>
                                <div class="col-sm-4"></div>-->
                <p>Copyright &copy; 2018 cleannigeria.org</p>
            </div>

        </div>

    </div>

</footer>

</div>

<!-- jQuery -->
<script src="{{ asset('bootstrap_assets/js/jquery.js') }}" type="text/javascript"></script>

<script src="{{ asset('bootstrap_assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--<script src="{{ asset('bootstrap_assets/js/jquery.validate.js') }}"" type="text/javascript"></script>
<script src="{{ asset('bootstrap_assets/js/jquery.steps.js') }}" type="text/javascript"></script>
<script src="{{ asset('bootstrap_assets/js/script.js') }}" type="text/javascript"></script>-->
<!--custom jquery-->
<script src="{{ asset('bootstrap_assets/js/myapp.js') }}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{{asset('admin_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}">
</script>

<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/share.js') }}"></script>

<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);

 //Date picker
 $('#datepicker').datepicker({
      autoclose: true
    })
      //Date picker1
    $('#datepicker1').datepicker({
      autoclose: true
    })
</script>

</body>
</html>
