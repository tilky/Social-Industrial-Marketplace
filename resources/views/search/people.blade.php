@extends('buyer.app')

@section('content')
<style>
@charset "utf-8";
/* CSS Document */

.mt-comments .result .mt-comment-body {
	overflow: visible !important;
	padding-left: 105px;
}
.mt-comments .result:hover {
	background:none;
}
.mt-comments .result .mt-comment-body span.label {
	margin-right: 8px !important;
	border-radius:25px;
	color:#000;
	font-weight: 600;
}
.mt-comments .result .mt-comment-body span.label-warning {
	background-color: #F3C200;
}
.mt-comments .result .mt-comment-body span.label-default {
	background-color: #E0E0E0;
}
.mt-comments .result .mt-comment-img {
	width: 45px;
}
.mt-comments .result .mt-comment-author {
	margin-right:5px !important;
}
.mt-comments .result .mt-comment-author a {
	color:#0C0;
}
.result .mt-comment-text {
	padding:2px 0px;
}
.mt-comments .result .mt-comment-info {
	float: left;
	width: 100%;
}
.center-nav { float: none !important; margin-bottom:-4px !important;}

.center-nav>li>a {
	padding: 12px 54px 13px !important;
}
.filter_list ul {
	margin:0px;
	padding:0px;
	list-style:none;
}
.mt-comments .result .mt-comment-img {
    width: 90px;
    height: 90px;
	margin:1px 0px;
    float: left;
}
.mt-comments .result .mt-comment-img img {
    width: 90px;
    height: 90px;
}
.filter_list ul li {
	padding:15px 0px;
	border-bottom: 4px solid #36c6d3;
}
.no_filter{ float:none;}
.filter_list ul li ul li {
	border-bottom: 1px solid #999 !important;
}
.filter_list ul li a {
	color:#999;
}
.filter_list .task-list {
	width:100%;
	float:left;
}
.result{min-height: 90px;}
.mt-comments p{margin: 0px!important;}
.fliter:hover, .fliter:focus{ text-decoration:none;}
 @media(max-width:991px) {
 .center-nav>li>a {
 padding: 12px 55px 13px !important;
}
}
 @media(max-width:767px) {
 .center-nav>li>a {
 padding: 12px 24px 13px !important;
}
}
 @media(max-width:480px) {
 .center-nav>li>a {
 padding: 12px 4px 13px !important;
}
.result .mt-comment-body span.label {
 margin-right: 8px !important;
 margin-bottom: 8px;
 display: inline-block;
}

</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/contactusers">Contact List</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Contact</span>
        </li>
    </ul>
</div>
<!--<h3 class="page-title"> Result for Search: "{{$search}}" </h3>-->
<div class="portlet light search_filter ">
                      <div class="portlet-title">
                        <div class="caption bold"> REFINE SEARCH </div>
                        <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title="">  </a> </div>
                      </div>
                      <div class="portlet-body panel-collapse ">
                        <div class="mt-element-list">
                          <div class="mt-list-container">
                            <h4 class="bold">RESULT TYPE</h4>
                            <label><input type="checkbox" /> Verified Results Only</label>
                            <label><input type="checkbox" /> Valued Accounts Only</label>
                          </div>
                          <div class="mt-list-container">
                            <h4 class="bold">SHOW RESULTS WITHIN</h4>
                            <select>
                            <option>50</option>
                            <option>100</option>
                            <option>200</option>
                            </select>
                            <h4 class="bold pull-left">MILES OF</h4>
                            <input placeholder="ZIP" class="text-center" />
                            <div class="clearfix"></div>
                          </div>
                          <div class="mt-list-container">
                            <h4 class="bold">FILTER BY INDUSTRY</h4>
                            <label><input type="checkbox" /> Engineering (5)</label>
                            <label><input type="checkbox" /> Information Technology</label>
                            
                          </div>
                          <div class="mt-list-container">
                            <h4 class="bold">FILTER BY STATE</h4>
                            <label><input type="checkbox" /> California (5)</label>
                            <label><input type="checkbox" /> New Jersey (2)</label>
                          </div>
                        </div>
                      </div>
                    </div>
<div class="search_results main_box">
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light ">
            @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            @if($search != '')
           
            <div class="portlet-title tabbable-line text-center ">
                <ul class="nav nav-tabs center-nav">
                    <li class="all_result_tab">
                        <a href="{{url('general/search')}}?query={{$_REQUEST['query']}}" >All Results</a>
                    </li>
                    <li class="active people_tab">
                        <a href="{{url('people/search')}}?query={{$_REQUEST['query']}}">People</a>
                    </li>
                    <li class="company_tab">
                        <a href="{{url('company/search')}}?query={{$_REQUEST['query']}}" >Companies</a>
                    </li>
                    
                    <li class="product_tab">
                        <a href="{{url('product/search')}}?query={{$_REQUEST['query']}}">Products</a>
                    </li>
                    <li class="job_tab">
                        <a href="{{url('jobs/search/result')}}?query={{$_REQUEST['query']}}">Jobs</a>
                    </li>
                </ul>
            </div>
             <div class="portlet-body people_tab_body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_comments_1"> 
                        <!-- BEGIN: Comments -->
                        @if(count($results) > 0)
                            <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                            <div class="row">
                                <p class="text-right res_found">@if($total == 1){{$total}} Result Found @else {{$total}} Results Found for {{$search}} @endif</p>
                                </div>
                            </div>
                             <div class="clearfix"></div>
                            @foreach ($results as $result)
                                <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                    <p class="text-right res_found">&nbsp;</p>
                                    <div class="mt-comment result">
                                        <div class="mt-comment-img"> 
                                            <a href="{{url('home/user/profile')}}/{{$result->id}}" target="_blank">
                                            @if($result->userdetail->profile_picture != '')
                                            <img src="{{url('')}}/{{$result->userdetail->profile_picture}}" alt="{{$result->userdetail->first_name}} {{$result->userdetail->last_name}}" class="img-circle">
                                            @else
                                            <img src="{{url('images/default-user.png')}}" alt="{{$result->userdetail->first_name}} {{$result->userdetail->last_name}}" class="img-circle" width="80px">
                                            @endif
                                            </a>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info"> 
                                                <a href="{{url('home/user/profile')}}/{{$result->id}}" target="_blank">
                                                <span class="mt-comment-author font-20">
                                                    {{$result->userdetail->first_name}} {{$result->userdetail->last_name}}
                                                </span>
                                                </a>
                                                @if($result->star == 'gold')
                                                <span class="label label-sm label-warning gold-member caps-on"> Gold Supplier </span> 
                                                @elseif($result->star == 'silver')
                                                <span class="label label-sm label-default silver-member caps-on"> Silver Supplier </span> 
                                                @else
                                                <span class="label label-sm label-default free-member caps-on"> Free Member </span> 
                                                @endif
                                                @if($result->quotetek_verify == 1)
                                                <span class="label label-sm label-default verify-member caps-on"> Verified Member</span>
                                                @else
                                                <span class="label label-sm label-default verify-member caps-on"> Not Verified Member</span>
                                                @endif
                                                <div class="actions pull-right">
                                                    <div class="btn-group"> 
                                                        <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{url('home/user/profile')}}/{{$result->id}}" target="_blank">
                                                                    <i class="icon-docs"></i> View Profile </a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('messages/create')}}?buyer={{$result->id}}" target="_blank">
                                                                    <i class="fa fa-envelope-o"></i> Message </a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('contactusers/contact/send/')}}/{{Auth::user()->id}}/{{$result->id}}" target="_blank">
                                                                    <i class="fa fa-send-o"></i> Connect </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$result->id}}" >
                                                                    <i class="fa fa-thumbs-up"></i> Endorse </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="mt-comment-author">
                                                @if($result->userdetail->current_position != '')
                                                {{$result->userdetail->current_position}}
                                                @endif
                                                @if($result->company_name != '')
                                                    , {{$result->company_name}}
                                                @endif
                                            </span>
                                            <div class="mt-comment-text">{{substr($result->userdetail->about,0,90)}}</div>
                                            <span class="mt-comment-status">@if($result->userdetail->city != ''){{$result->userdetail->city}},{{$result->userdetail->state}},{{$result->userdetail->country}} @endif @if($result->userdetail->getUserIndustry)| {{$result->userdetail->getUserIndustry->name}}@endif</span> 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="mt-comments col-md-12 col-sm-12 center-block float_none">
                            <div class="row">
                                <p class="text-center res_found">No Users found. Please try another search query.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
                <p>Nothing to search</p>
            @endif
        </div>
        <div class="col-md-12 align-center">
            {!! $results->render() !!}
        </div>
              
    </div>
</div>
</div>
<script>
    /* for show menu active */
    $("#dashboard-menu").addClass("active");
	/* end menu active */
    
</script>
@endsection
