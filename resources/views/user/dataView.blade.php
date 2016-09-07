@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>User</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> User Profile View
</h3>
<div class="row">
    <div class="col-md-12">
        @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
        @endif
        @include('user.user-sidebar')
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-6">
                    <!-- BEGIN reviews -->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Reviews</span>
                                <span class="caption-helper hide">weekly stats...</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable table-scrollable-borderless">
                                @if(count($reviews) > 0)
                                    @foreach($reviews as $index=>$review)
                                        @if($index < 5)
                                        <div class="media">
                                            <a class="pull-left" href="{{url('home/user/profile')}}/{{$review->sender_id}}" target="_blank">
                                                @if($review->sender_avatar != '')
                                                <img src="{{url('')}}/{{$review->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                                @else
                                                <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <div class="col-md-12 paddin-npt">
                                                    <div class="col-md-12 paddin-npt">
                                                        <a class="font-wh" href="{{url('home/user/profile')}}/{{$review->sender_id}}" target="_blank"><h3 class="media-heading">{{$review->sendername}}</h3></a>
                                                        @if($review->companyname != '')<span>Position at {{$review->companyname}}</span>@endif
                                                        <h5>{{$review->title}}</h5>
                                                        <p>{{$review->comment}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 paddin-npt">
                                                    <div class="col-md-12 paddin-npt">
                                                        <p>
                                                        @for ($i=1; $i <= 5 ; $i++)
                                                          <span class="stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                                        @endfor
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                <p>No Review available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- END reviews -->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN endorsment -->
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Endorsements</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable table-scrollable-borderless">
                                @if(count($endorsements) > 0)
                                    @foreach($endorsements as $index=>$endorsement)
                                        @if($index < 5)
                                        <div class="col-md-12 padding-top paddin-bottom">
                                            <a class="pull-left" href="{{url('home/user/profile')}}/{{$endorsement->sender_id}}" target="_blank">
                                                @if($endorsement->sender_avatar != '')
                                                <img src="{{url('')}}/{{$endorsement->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                                @else
                                                <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                @endif
                                            </a>
                                            <div class="media-body padding-left">
                                                <a class="font-wh" href="{{url('home/user/profile')}}/{{$endorsement->sender_id}}" target="_blank"><h3 class="media-heading">{{$endorsement->sendername}}</h3></a>
                                                @if($endorsement->companyname != '')<span>Position at {{$endorsement->companyname}}</span>@endif
                                                <div class="text-muted"><small>Endorsed on {!! $endorsement->created_at->diffForHumans() !!}</small></div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                <p>No endorsement</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- END endorsement -->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN endorsment -->
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Feedbacks</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable table-scrollable-borderless">
                                @if(count($feedbacks) > 0)
                                    @foreach($feedbacks as $index=>$feedback)
                                        @if($index < 5)
                                        <div class="col-md-12 padding-top paddin-bottom">
                                            <a class="pull-left" href="{{url('home/user/profile')}}/{{$feedback->sender_id}}" target="_blank">
                                                @if($feedback->sender_avatar != '')
                                                <img src="{{url('')}}/{{$feedback->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                                @else
                                                <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                @endif
                                            </a>
                                            <div class="media-body padding-left">
                                                <div class="col-md-12 paddin-npt">
                                                    <div class="col-md-12 paddin-npt">
                                                        <a class="font-wh" href="{{url('home/user/profile')}}/{{$feedback->sender_id}}" target="_blank"><h3 class="media-heading">{{$feedback->sendername}}</h3></a>
                                                        @if($feedback->companyname != '')<span>Position at {{$feedback->companyname}}</span>@endif
                                                        <p>{{$feedback->comment}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                <p>No Feedback available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- END endorsement -->
                </div>
            </div>
            
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<script>
$('#user-profile-view').addClass('active');
</script>
@endsection
