@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Reviews Left</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>Manage Left Reviews </div>
                <div class="actions">
                    <a href="{{ url('review/create') }}" class="btn btn-circle btn-danger btn-sm">
                        <i class="fa fa-plus"></i> Send Review </a>
                </div>
            </div>
            <div class="portlet-body">
            
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        @if(count($reviews) > 0)
                            @foreach($reviews as $review)
                            <div class="media">
                                @if($review->receiver->access_level == 4)
                                <a class="pull-left" href="{{url('company/profile')}}/{{$review->receiver->companydetail->id}}" target="_blank">
                                    @if($review->receiver_avatar != '')
                                    <img src="{{url('')}}/{{$review->receiver_avatar}}" alt="sell" class="img-circle" width="50px">
                                    @else
                                    <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <div class="col-md-12 paddin-npt">
                                        <div class="col-md-8 paddin-npt">
                                            <a href="{{url('company/profile')}}/{{$review->receiver->companydetail->id}}" target="_blank"><h3 class="media-heading">{{$review->receivername}}</h3></a>
                                            <h5>{{$review->title}}</h5>
                                            <p>{{$review->comment}}</p>
                                        </div>
                                        <div class="text-muted col-md-4 align-right paddin-npt"><small>Review left {!! $review->created_at->diffForHumans() !!}</small></div>
                                    </div>
                                    <div class="col-md-12 paddin-npt">
                                        <div class="col-md-6 paddin-npt">
                                            <p>
                                            @for ($i=1; $i <= 5 ; $i++)
                                              <span class="stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                            @endfor
                                            </p>
                                        </div>
                                        <div class="col-md-6 paddin-npt align-right">
                                            <a href="{{url('/review-user/profile')}}/{{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">View Profile</a> | 
                                            <a href="{{url('messages/create')}}?buyer={{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">Message</a> | 
                                            @if($review->endorse == 0)<a href="{{url('endorse-user')}}/{{$review->sender_id}}/{{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">Endorse</a> | @endif 
                                            <a href="" class="btn-link" style="color: #e7505a;">Showcase</a> 
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a class="pull-left" href="{{url('home/user/profile')}}/{{$review->receiver_id}}" target="_blank">
                                    @if($review->receiver_avatar != '')
                                    <img src="{{url('')}}/{{$review->receiver_avatar}}" alt="sell" class="img-circle" width="50px">
                                    @else
                                    <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <div class="col-md-12 paddin-npt">
                                        <div class="col-md-8 paddin-npt">
                                            <a href="{{url('home/user/profile')}}/{{$review->receiver_id}}" target="_blank"><h3 class="media-heading">{{$review->receivername}}</h3></a>
                                            @if($review->companyname != '')<span>Position at {{$review->companyname}}</span>@endif
                                            <h5>{{$review->title}}</h5>
                                            <p>{{$review->comment}}</p>
                                        </div>
                                        <div class="text-muted col-md-4 align-right paddin-npt"><small>Review left {!! $review->created_at->diffForHumans() !!}</small></div>
                                    </div>
                                    <div class="col-md-12 paddin-npt">
                                        <div class="col-md-6 paddin-npt">
                                            <p>
                                            @for ($i=1; $i <= 5 ; $i++)
                                              <span class="stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                            @endfor
                                            </p>
                                        </div>
                                        <div class="col-md-6 paddin-npt align-right">
                                            <a href="{{url('/review-user/profile')}}/{{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">View Profile</a> | 
                                            <a href="{{url('messages/create')}}?buyer={{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">Message</a> | 
                                            @if($review->endorse == 0)<a href="{{url('endorse-user')}}/{{$review->sender_id}}/{{$review->receiver_id}}" class="btn-link" style="color: #e7505a;">Endorse</a> | @endif 
                                            @if($review->connect == 0)<a href="{{url('contactusers/create')}}?search={{str_replace(' ','+',$review->receivername)}}" class="btn-link" style="color: #e7505a;">Connect</a> | @endif 
                                            <a href="" class="btn-link" style="color: #e7505a;">Showcase</a> 
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @else
                        No Review sent
                        @endif
                    </div>
                </div>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> ← Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next → </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#review-main-menu").addClass("active");
	$('#review-main-menu' ).click();
    $('#review-menu-arrow').addClass('open');
	$('#review-sent-menu').addClass('active');
    /* end menu active */
    
    
</script>
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection
