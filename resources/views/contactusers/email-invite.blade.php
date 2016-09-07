@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Send Email Invitation</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-envelope color-black"></i> Invite Users by email
</h3>
</div>
</div>
<div class="row">

    <div class="col-md-12">
            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                
                
                <div class="row">
                    <div class="col-md-12">
              
                 <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
<div class="row">
<h3 class="block  align-left"><span style="font-size: 20px!important;">Invite users to Indy John by E-mail and begin earning using our Referral Program. </span></h3></div>


                </div>
                
                
                    
                    <form method="post" action="{{url('invite/email/contact')}}" class="form-horizontal form-row-seperated" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-body">
                            
                            <div class="col-md-12">
                              <div class="row">
                


                                <div class="form-group">
                               
                                
                                
                                    <label>Enter multiple Email Addresses seperated by a comma:<span></span></label>
                                    <textarea class="form-control" name="email" placeholder="You can enter up-to 100 e-mails seperated by a comma."></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-actions right margin-top-15">
                            <button type="submit" class="btn btn-circle yellow-crusta">
                                <i class="fa fa-forward"></i> Send Invitations </button>
                        </div>
                    </form>
               
                    </div>
                </div>
                
            </div>
    </div>
</div>
</div>
<script>
    /* for show menu active */
    $("#invite-main-menu").addClass("active");
	$('#invite-main-menu' ).click();
	$('#invite-menu-arraow').addClass('open')
	$('#emailinvite-view-menu').addClass('active');
    /* end menu active */
    
</script>
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection
