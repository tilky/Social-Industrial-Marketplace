@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Referral URLs</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">

        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase">
                <i class="fa fa-envelope"></i>  
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Referral Code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($total > 0)
                                    @foreach($referralLink as $referral)
                                    <tr>
                                        <td>{{$referral->userName}}</td>
                                        <td>{{$referral->referral_code	}}</td>
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
    $('#referral-url-menu').addClass('active');
    /* end menu active */

</script>
@endsection
