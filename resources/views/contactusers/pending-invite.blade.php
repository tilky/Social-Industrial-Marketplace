@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Your Pending Referrals </span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-server"></i>  Your Pending Referrals
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if(count($invitedContacts) > 0)

 <div class="col-md-9 paddin-npt">
                <p class="caption-helper">These are people that you have invited to Indy John.</p>
            </div>
<div class="col-md-12">
<div class="row">
<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <!--<th>Phone</th>
                        <th>Company</th>-->
                        <th style="width: 280px;"> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($invitedContacts as $invitedContact)
                        <tr>
                            <td>{{$invitedContact->name}}</td>
                            <td>{{$invitedContact->email}}</td>
                            <!--<td>{{$invitedContact->phone}}</td>
                            <td>{{$invitedContact->company}}</td>-->
                            <td class="no-sort" style="text-align:right">
                                <a href="{{url('contact/invite/send')}}/{{$invitedContact->id}}?pedingInvite=1" class="btn btn-circle yellow-crusta color-black ">
                                    <i class="fa fa-user-plus"></i>  Invite Again</a>
                                <a href="{{url('contact/invite/remove')}}/{{$invitedContact->id}}?pedingInvite=1" class="btn btn-circle btn-danger">
                                    <i class="fa fa-remove"></i>  Remove </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
                </div>
                @else
                <div class="col-md-12">
                    <p>No Invitation Pending</p>
                </div>
                @endif
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i>  Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i>  </a>
                    </li>
                    @endif
                </ul>
            </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#referrals-main-menu").addClass("active");
$('#referrals-main-menu' ).click();
$('#referrals-menu-arrow').addClass('open')
$('#contact-pandding-invite-menu').addClass('active');
/* end menu active */
</script>
@endsection
