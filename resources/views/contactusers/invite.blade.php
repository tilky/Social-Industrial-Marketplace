@extends('buyer.app')

@section('content')
<style>
.media:first-child{margin-top: 15px!important;}
.invite-contact{background: none!important;padding: 10px;min-height: 105px;}
.invite-contact-div{max-height: 265px;overflow: auto;}
.invite-contact-sec-div{max-height: 500px;overflow: auto;}
.cust-m{margin: 10px!important;text-align: left!important;min-height: 80px!important;}
@media (min-width: 992px){
.cust-m {
    width: 31.5%!important;
}
}
.cust-m.active, .cust-m:active, .cust-m:hover, .open>.cust-m.dropdown-toggle{background-color: #E7E5E6 !important;color: #000!important;border-color: #000!important;}
</style>
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
            <span>Send Invitation</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-plus color-black"></i> Invite your {{$type}} Contacts to Indy John
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
                        <form method="post" action="{{url('invite/user/contact')}}" class="form-horizontal form-row-seperated" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                                <div class="">
                                    <div class="col-md-12">
                                        <h3>Connect With Users Already On Indy John.</h3>
                                    </div>
                                    @if(!empty($contactusers))
                                    <div class="col-md-12 btn-group invite-contact-div" data-toggle="buttons">
                                        @foreach($contactusers as $cn_index=>$contact)
                                        <div class="media btn btn-circle cust-m col-md-4">
                                            <div class="invite-contact">
                                                <a class="pull-left" href="{{url('home/user/profile')}}/{{$contact['req_user_id']}}" target="_blank">
                                                    @if($contact['req_user_picture'] != '')
                                                    <img src="{{url('')}}/{{$contact['req_user_picture']}}" alt="sell" class="img-circle" width="50px">
                                                    @else
                                                    <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                                    @endif
                                                </a>
                                                <div class="media-body">
                                                    <div class="col-md-12 paddin-npt">
                                                        <div class="col-md-8 paddin-npt">
                                                            <a href="{{url('home/user/profile')}}/{{$contact['req_user_id']}}" target="_blank"><h3 class="media-heading">{{$contact['req_user_name']}}</h3></a>
                                                            <p>{{$contact['req_user_email']}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 paddin-npt">
                                                        <div class="col-md-6">&nbsp;</div>
                                                        <div class="col-md-6 paddin-npt align-right">
                                                             @if($contact['common_req'] == 1)
                                                                <p>Request Pending</p>
                                                             @else
                                                                <input type="checkbox" name="contact[{{$cn_index}}]" class="toggle" value="{{$contact['req_user_id']}}" />
                                                             @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                        <p class="col-md-12">None of your contacts are on Indy John yet. Invite them and start earning referral payouts.</p>
                                    @endif
                                    <div class="col-md-12">
                                        <h3>Invite Your Network</h3>
                                    </div>
                                    @if(!empty($invites))
                                    <div class="col-md-12 btn-group invite-contact-sec-div" data-toggle="buttons">
                                        @foreach($invites as $index=>$invite)
                                        <input type="hidden" name="invitename[{{$index}}]" value="{{$invite['name']}}" />
                                        <div class="media btn btn-circle cust-m col-md-4 col-sm-4">
                                            <h4 class="media-heading">{{substr($invite['name'], 0, 25)}}</h4>
                                            <p>{{$invite['email']}}</p>
                                            <input type="checkbox" name="invite[{{$index}}]" class="toggle" value="{{$invite['email']}}" />
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                        <p class="col-md-12">No result found for invite</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-circle yellow-crusta bold color-black">
                                    <i class="fa fa-check"></i> Send Invitations</button>
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
	$('#invite-menu-arraow').addClass('open');
    var type = '{{$type}}';
    if( type == 'Google')
    {
        $('#google-invite-view-menu').addClass('active');
    }
    else if(type == 'Yahoo')
    {
        $('#yahoo-invite-view-menu').addClass('active');
    }
    else
    {
        $('#msn-invite-view-menu').addClass('active');
    }
	/* end menu active */
    
</script>
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection
