@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Referrals</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-envelope"></i>  @if(Auth::user()->access_level == 1) List all Referred Users @else View Your Referrals @endif
</h3>

</div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
       
            
            <div class="portlet-body">
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        {!! Session::get('error_message') !!}
                    </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if(Auth::user()->access_level != 1)
                <p class="caption-helper">Thank you for your Referrals. Here is a list of users that have signed up using your referral link or code.</p>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Signed up</th>
                                    <th>Valued Account</th>
                                    <th>Value Account Sign Up Date</th>
                                    <th>Referral Generated</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($total > 0)
                                @foreach($referrals as $referral)
                                <tr>
                                    <td>{{$referral->first_name}} {{$referral->last_name}}</td>
                                    <td>{{date('m-d-Y',strtotime($referral->created_at))}}</td>
                                    <td>@if($referral->paid_referral_by == 1)Yes @else No @endif</td>
                                    <td>@if($referral->paid_referral_by == 1){{date('m-d-Y',strtotime($referral->updated_at))}} @endif</td>
                                    <td>@if($referral->payment) {{$referral->payment->amount}} @endif</td>
                                    <td>{{$referral->status}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        </div>
                        @if($total == 0)
<!--
                            <p class="caption-helper">
                                <span>Can you use some extra income? All Indy John users can earn residual income by taking advantage of Indy John's referral program. 
                                Simply tell your Industrial friends about us, if your referral selects one of our valued accounts we'll split your referral's first month payment 50/50 as a sign of appreciation.</span><br>
                                <a href="{{url('referral-link/about-the-program')}}" class="btn btn-circle yellow-crusta color-black btn-small" style="margin-top: 10px;">LEARN MORE</a>
                            </p> -->
                        @endif
                    </div>
                </div>
                <ul class="pager" style="margin-top:0px !important;">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a class="btn btn-danger" href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i>  Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a class="btn btn-danger" href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i>  </a>
                    </li>
                    @endif
                </ul>
                  @if($total > 0)
        <div>
        @if(Auth::user()->access_level != 1)
            <div class="form-actions text-right margin-bottom-15">
                <a href="{{url('invite/email')}}" class="btn btn-circle btn-sm yellow-crusta color-black text-upper"><i class="fa fa-plus"></i>  Refer More Users</a>
                <a href="{{url('supporttickets/create')}}" class="btn btn-circle btn-sm yellow-crusta color-black text-upper"><i class="fa fa-support"></i>  Contact Support</a>
            </div>
        @endif
        </div>
        @endif
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
$('#view-referrals-menu').addClass('active');
/* end menu active */
    
</script>
@endsection
