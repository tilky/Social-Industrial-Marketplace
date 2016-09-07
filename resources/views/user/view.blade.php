@extends('buyer.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>User Profile</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> View User Profile
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>  {{$userData->first_name}} {{$userData->last_name}} 
                </div>
            </div>
            <div class="portlet-body form">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h3>{{$userData->first_name}} {{$userData->last_name}}</h3>
                            <div class="col-md-3 col-sm-3 col-xs-3 paddin-npt">
                                <ul class="nav nav-tabs tabs-left">
                                    <li class="active">
                                        <a href="#tab_6_1" data-toggle="tab"> Profile </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_2" data-toggle="tab"> Reviews </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_3" data-toggle="tab"> Endorsements </a>
                                    </li>
                                    <li>
                                        <a href="#tab_6_4" data-toggle="tab"> Feedbacks </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_6_1">
                                        <div class="col-md-12 paddin-npt paddin-bottom">
                                            @if($company != '')
                                            <div class="col-md-6 paddin-npt">
                                                <label>Industries :</label>
                                                @foreach ($company->industries as $industry)
                                                <p><b>{{ $industry->industry->name }}</b> - <a href="{{url('industries')}}/{{$industry->industry->id}}/edit" target="_blank">view full profile</a></p></p>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 paddin-npt">
                                                <label class="col-md-12">Compnay :</label>
                                                <div class="col-md-3 paddin-npt">
                                                    <img src="{{$company->logo}}" height="100" width="100" style="border-radius: 50px!important;"/>
                                                </div>
                                                <div class="col-md-9 paddin-npt">
                                                    <p>{{$company->name}}</p>
                                                    <p>{{$company->description}}</p>
                                                    <p><a href="{{url('companies')}}/{{$company->id}}" target="_blank">view full profile</a></p>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-6 paddin-npt">
                                                <label class="col-md-12 paddin-npt">Address :</label>
                                                <h4>{{$userData->first_name}} {{$userData->last_name}}</h4>
                                                {{$userData->address1}}<br/>
                                                @if($userData->address2 != ''){{$userData->address2}}<br/>@endif
                                                {{$userData->city}},{{$userData->state}} - {{$userData->zip}}<br/>
                                                {{$userData->country}}<br/>
                                                T: {{$userData->phone}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_6_2">
                                        @if(count($reviews) > 0)
                                            @foreach($reviews as $review)
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                </a>
                                                <div class="media-body">
                                                    <div class="col-md-12 paddin-npt">
                                                        <div class="col-md-8 paddin-npt">
                                                            <h3 class="media-heading">{{$review->sendername}}</h3>
                                                            @if($review->companyname != '')<span>Position at {{$review->companyname}}</span>@endif
                                                            <h5>{{$review->title}}</h5>
                                                            <p>{{$review->comment}}</p>
                                                            <p>
                                                            @for ($i=1; $i <= 5 ; $i++)
                                                              <span class="stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                                            @endfor
                                                            </p>
                                                        </div>
                                                        <div class="text-muted col-md-4 align-right paddin-npt"><small>Review received {!! $review->created_at->diffForHumans() !!}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                        <p>No Review available</p>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="tab_6_3">
                                        @if(count($endorsements) > 0)
                                            @foreach($endorsements as $endorsement)
                                                <div class="col-md-6 padding-top paddin-bottom">
                                                    <a class="pull-left" href="#">
                                                        <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                    </a>
                                                    <div class="media-body padding-left">
                                                        <h3 class="media-heading">{{$endorsement->sendername}}</h3>
                                                        @if($endorsement->companyname != '')<span>Position at {{$endorsement->companyname}}</span>@endif
                                                        <div class="text-muted"><small>Endorsed on {!! $endorsement->created_at->diffForHumans() !!}</small></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                       You have not recived any endorsements yet.
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="tab_6_4">
                                        @if(count($feedbacks) > 0)
                                            @foreach($feedbacks as $feedback)
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-circle">
                                                </a>
                                                <div class="media-body">
                                                    <div class="col-md-12 paddin-npt">
                                                        <div class="col-md-8 paddin-npt">
                                                            <h3 class="media-heading">{{$feedback->sendername}}</h3>
                                                            @if($feedback->companyname != '')<span>Position at {{$feedback->companyname}}</span>@endif
                                                            <p>{{$feedback->comment}}</p>
                                                        </div>
                                                        <div class="text-muted col-md-4 align-right paddin-npt"><small>Feedback received {!! $feedback->created_at->diffForHumans() !!}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                        <p>No Feedback available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection
