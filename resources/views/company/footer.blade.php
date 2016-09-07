<!-- BEGIN FOOTER -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="basic1" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title" style="text-transform: uppercase;">Help us Improve</h3>
                <p class="caption-helper" style="margin: 5px 0px!important;">Your feedback helps us understand what we do well and where we can improve.</p>
            </div>
            <form action="{{url('feedback/message')}}" method="post" class="horizontal-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Subject:</label>
                            <div class="">
                                <input type="text" name="subject" class="form-control" placeholder="Add a subject line for your feedback" />
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">Summary:</label>
                            <div class="">
                                <textarea name="message" class="form-control" rows="4" placeholder="Please provide any details related to your subject."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle default" data-dismiss="modal">Close</button>
                    <button type="submite" class="btn btn-circle blue">Send</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- password-model --->
<div class="modal fade reset-password" id="reset-password" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class=" text-uppercase text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i>  </span></button>
                <h3>Welcome to Indy John</h3>
                <!--                        <h5>so that we can prepare your account</h5>-->
                <form role="form" method="POST" action="{{url('saveResetPassword')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-inline">
                        <h4>Please set your password: </h4>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" name="password" id="password" class="form-control"  value="" placeholder="PASSWORD" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" name="rpassword" id="rpassword" class="form-control"  value="" placeholder="REPEAT PASSWORD" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline ">

                        <h4 style="padding:0px !important">&nbsp;</h4>
                        <div align="center" class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button class="btn_red  hvr-bounce-to-right" type="submit" onclick="return checkPassword();">SET PASSWORD </button>
                            <h6>You Agree To Our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>


<!-- welcome-model --->
<div class="modal fade user-welcome-modal" id="user-welcome-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
            </div>
            <div class="modal-body">
                <div class=" text-uppercase text-center">
                    <input type="hidden" id="user-reg-first" value="@if(Session::has('new_user_first')) 1 @endif" />
                    @if(Auth::user()->is_using_temporary_password == 0)
                    <h3>Welcome, {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}</h3>
                    @endif

                    <h4>Let's begin by creating a User Profile. </br> Our Profile Setup might take a few extra minutes, but this will ensure that you're making</h4>
                    <h4 style="color:#ef5350;">Meaningful Industrial Connections.</h4>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">BEGIN PROFILE SETUP</button>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>

    </div>
</div>


<!-- /.modal -->
<div class="page-footer">
    <div class="page-footer-inner"> © Indy John Inc. All Rights Reserved. <a href="javascript:void(0);" id="footer-feedback"><b>Feedback</b></a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>  
    </div>
</div>
<script>
$('#footer-feedback').click(function(){
    jQuery('#basic1').modal('show');    
});

function getQueryStringValue (key) {
    return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}
</script>

@if(Auth::user()->is_using_temporary_password == 1)
<script>
$(document).ready(function() {
    if(getQueryStringValue("popup") == 'upgrade')
    {
        $('#reset-password').modal('show');
    }
    if(getQueryStringValue("popup") == 'overview')
    {
        $('#reset-password').modal('show');
    }
});
</script>
@endif

<script>
    $(document).ready(function() {
        if(getQueryStringValue("popup") == 'welcome')
        {
            $('#user-welcome-modal').modal('show');
        }

        if(getQueryStringValue("popup") == 'company_import')
        {
            $('#company_import_model').modal('show');
        }
    });

    /*$(document).ready(function() {

        var first = $('#user-reg-first').val();

        if(first == 1)
        {
            $('#user-welcome-modal').modal('show');
            clock();
        }

    });*/
</script>


<script>
function checkPassword(){
    if(document.getElementById('password').value != document.getElementById('rpassword').value){
        alert("Whoops, password don't match");
        return false;
    }else if(document.getElementById('password').value == "" || document.getElementById('rpassword').value == ""){
        alert("Please Enter a password");
        return false;
    }
}

function editProfile(){
    var user_url = "{{url('user-details')}}";
    window.location.href = user_url;
}
</script>

<!-- END FOOTER -->
