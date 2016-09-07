@extends('buyer.app')

@section('content')
<style>

.product_demo .owl-prev{top: 30%!important; left: -15px!important;}

.product_demo .owl-next{top: 30%!important; right: -15px!important;}

.content-img{width: 97%!important;}

.owl-item{padding: 0px 10px!important;}

.test_descri{font-size: 18px;}

.thumbnail{position: relative;}

.white_carasoul .owl-pagination{margin-top: 20px!important;}

.section {padding: 0px !important;}





</style>
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet">

<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />



<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">

<link href="{{URL::asset('js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{URL::asset('css/animations.css')}}" type="text/css">

<link rel="stylesheet" href="{{URL::asset('css/prettyPhoto.css')}}">



<link rel="stylesheet" href="{{URL::asset('css/owl.theme.css')}}">

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/ng_responsive_tables.css')}}">
<style>

    .invoice-content-2 {

        border-radius: 5px;

        margin: 10px;

        padding: 0 !important;

    }

.list-inline>li{padding: 0px!important;}

.padding-right-20{padding-right: 20px!important;}

.btn_org-silver {

background: #c0c0c0 none repeat scroll 0 0;

border: 2px solid transparent;

border-radius: 10px;

box-shadow: 0 0 1px rgba(0, 0, 0, 0);

display: inline-block;

font-family: "Raleway",sans-serif;

font-size: 20px;

font-weight: 500;

overflow: hidden;

padding: 5px 30px;

position: relative;

text-transform: uppercase;

transform: translateZ(0px);

transition: all 0.3s ease-in 0s;

width: 100%;

margin-top: 5px;

color: #000!important;

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
                    <li class="active all_result_tab">
                        <a href="{{url('general/search')}}?query={{$_REQUEST['query']}}" >All Results</a>
                    </li>
                    <li class="people_tab">
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
                        <div class="portlet-body all_result_tab_body">
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
                                
                                    
                                    @if($result->search_type == 'user')
                                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter all_people">
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
                                                <a <?php /*?>data-toggle="modal" href="#todo-task-modal"<?php */?> href="{{url('home/user/profile')}}/{{$result->id}}" target="_blank">
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
                                                <span class="label label-sm label-default verify-member caps-on"> Not Verified</span>
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
                                                                <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$result->id}})">
                                                                    <i class="fa fa-envelope-o"></i> Message </a>
                                                                <!--<a href="{{url('messages/create')}}?buyer={{$result->id}}" target="_blank">
                                                                    <i class="fa fa-envelope-o"></i> Message </a>-->
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('contactusers/contact/send/')}}/{{Auth::user()->id}}/{{$result->id}}" target="_blank">
                                                                    <i class="fa fa-send-o"></i> Connect </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$result->id}}">
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
                                    @elseif($result->search_type == 'company')
                                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter all_company">
                                    <div class="mt-comment result">
                                        <div class="mt-comment-img"> 
                                            <a href="{{url('company/profile')}}/{{$result->id}}" target="_blank">
                                            @if($result->logo != '')
                                            <img src="{{url('')}}/{{$result->logo}}" alt="{{$result->name}}" class="img-circle" />
                                            @else
                                            <img src="{{url('images/default-user.png')}}" alt="{{$result->name}}" class="img-circle" width="80px">
                                            @endif 
                                            </a>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info"> 
                                                <a <?php /*?>data-toggle="modal" href="#todo-task-modal"<?php */?> href="{{url('company/profile')}}/{{$result->id}}" target="_blank">
                                                <span class="mt-comment-author font-20">{{$result->name}}</span>
                                                </a>
                                                <div class="actions pull-right">
                                                    <div class="btn-group"> <a class="btn btn-circle btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{url('company/profile')}}/{{$result->id}}" target="_blank">
                                                                    <i class="icon-docs"></i> View Profile </a>
                                                            </li>
                                                            <li>
                                                                <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$result->user_id}})">
                                                                    <i class="fa fa-envelope-o"></i> Message Admin </a>
                                                                <!--<a href="{{url('messages/create')}}?buyer={{$result->user_id}}" target="_blank">
                                                                    <i class="fa fa-envelope-o"></i> Message Admin </a>-->
                                                            </li>
                                                            <li>
                                                                <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$result->user_id}}">
                                                                    <i class="fa fa-thumbs-up"></i> Endorse </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="mt-comment-author">
                                                 @if($result->industries)
                                                    @foreach($result->industries as $index=>$indurty)
                                                        @if($index == 0)
                                                        {{$indurty->Industry->name}}
                                                        @else
                                                        ,{{$indurty->Industry->name}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </span>
                                            <div class="mt-comment-text"> {{substr($result->description,0,90)}} </div>
                                            <span class="mt-comment-status">@if($result->city != ''){{$result->city}},{{$result->state}},{{$result->country}} @endif</span> 
                                        </div>
                                    </div>
                                    </div>
                                    @elseif($result->search_type == 'product')
                                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter all_product">
                                    <div class="mt-comment result">
                                        <div class="mt-comment-img"> 
                                            <a href="{{url('marketplaceproducts')}}/{{$result->id}}" target="_blank">
                                            @if($result->image != '')
                                            <img src="{{url('marketplace/product/images')}}/{{$result->image}}" alt="{{$result->name}}" class="img-circle" >
                                            @else
                                            <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="{{$result->name}}" class="img-circle" >
                                            @endif 
                                            </a>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info"> 
                                                <a href="{{url('marketplaceproducts')}}/{{$result->id}}" target="_blank">
                                                <span class="mt-comment-author font-20">{{$result->name}}</span>
                                                </a>
                                                <div class="actions pull-right">
                                                    <div class="btn-group"> <a class="btn btn-circle btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{url('marketplaceproducts')}}/{{$result->id}}" target="_blank">
                                                                    <i class="icon-docs"></i> View Listing </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('home/user/profile')}}/{{$result->seller->id}}" target="_blank">
                                                                    <i class="icon-docs"></i> View Seller Profile </a>
                                                            </li>
                                                            <li>
                                                                <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$result->seller->id}})">
                                                                    <i class="icon-docs"></i> Enquire </a>
                                                                <!--<a href="{{url('messages/create')}}?buyer={{$result->seller->id}}&product={{$result->id}}" target="_blank">
                                                                    <i class="icon-docs"></i> Enquire </a>-->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="mt-comment-author"><a href="#">${{$result->price}}</a> {{$result->brand_name}} | {{$result->model_number}}  | 
                                                @foreach($result->categories as $index=>$category)
                                                    @if($index < 3)
                                                        @if($index == 0)
                                                        {{$category->category->name}}
                                                        @else
                                                        ,{{$category->category->name}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                             </span>
                                            <div class="mt-comment-text"> Listed by : <a href="{{url('home/user/profile')}}/{{$result->seller->id}}" class="font18" target="_blank">{{$result->seller->userdetail->first_name}} {{$result->seller->userdetail->last_name}}</a> 
                                                @if($result->star == 'gold')
                                                <span class="label label-sm label-warning gold-member caps-on"> Gold Supplier </span> 
                                                @elseif($result->star == 'silver')
                                                <span class="label label-sm label-default silver-member caps-on"> Silver Supplier </span> 
                                                @else
                                                <span class="label label-sm label-default free-member caps-on"> Free Member </span>
                                                @endif
                                                @if($result->seller->quotetek_verify == 1)
                                                <span class="label label-sm label-default verify-member caps-on"> Verified </span>
                                                @else
                                                <span class="label label-sm label-default verify-member caps-on"> Not Verified </span>
                                                @endif
                                            </div>
                                            <span class="mt-comment-status">@if($result->seller->userdetail->city != ''){{$result->seller->userdetail->city}}, {{$result->seller->userdetail->state}}, {{$result->seller->userdetail->country}} @endif  @if($result->seller->userdetail->getUserIndustry)| {{$result->seller->userdetail->getUserIndustry->name}}@endif</span> 
                                        </div>
                                    </div>
                                    </div>
                                    @elseif($result->search_type == 'job')
                                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter all_job">
                                        <div class="mt-comment result">
                                            <div class="mt-comment-img"> 
                                                <a href="{{url('home/user/profile')}}/{{$result->user->id}}" target="_blank">
                                                @if($result->user->userdetail->profile_picture != '')
                                                <img src="{{url('')}}/{{$result->user->userdetail->profile_picture}}" alt="{{$result->user->userdetail->first_name}} {{$result->user->userdetail->last_name}}" class="img-circle">
                                                @else
                                                <img src="{{url('images/default-user.png')}}" alt="{{$result->user->userdetail->first_name}} {{$result->user->userdetail->last_name}}" class="img-circle" width="80px">
                                                @endif
                                                </a>
                                            </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info"> 
                                                    <a href="{{url('job/view')}}/{{$result->id}}" target="_blank">
                                                    <span class="mt-comment-author font-20">{{$result->title}}</span>
                                                    </a>
                                                    <div class="actions pull-right">
                                                        <div class="btn-group"> <a class="btn btn-circle btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="{{url('job/view')}}/{{$result->id}}" target="_blank">
                                                                        <i class="icon-docs"></i> View Listing </a>
                                                                </li>
                                                                @if($result->user_id != Auth::user()->id)
                                                                <li>
                                                                    <a href="{{url('job/user/save')}}/{{$result->id}}/{{Auth::user()->id}}">
                                                                        <i class="icon-check"></i> Save </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#job_apply" data-toggle="modal" data-target="#job_apply" onclick="ApplyJobModal({{$result->id}})">
                                                                        <i class="icon-check"></i> Apply
                                                                    </a>
                                                                    <!--<a href="{{url('job/user/apply')}}/{{$result->id}}/{{Auth::user()->id}}">
                                                                        <i class="icon-check"></i> Apply </a>-->
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-comment-author">
                                                    {{$result->job_type_function}} | {{$result->job_position_title}}  | {{$result->job_type}}
                                                </div>
                                                <div class="mt-comment-status">@if($result->city != ''){{$result->city}}, {{$result->state}}, {{$result->country}} @endif  </div>
                                            </div>
                                        </div>
                                        </div>
                                    @endif
                                
                            @endforeach
                        @else
                            <div class="mt-comments col-md-12 col-sm-12 center-block float_none">
                            <div class="row">
                                <p class="text-center res_found">No Results found for your search.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-center">
                {!! $results->render() !!}
            </div>
            @else
                <p>Nothing to search</p>
            @endif
        </div>
        
              
    </div>
</div>
</div>
<div id="todo-task-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content scroller" style="height: 100%;" data-always-visible="1" data-rail-visible="0">
                                <div class="modal-header">
                                    
                     
                <div class="profile-inner-section">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa fa-close"></i></button>
                    <div class="col-md-3 text-center profile_info">



                        <div class="stopMenu" id="stopMenu">

                            <div class="relative">

                                
                                <span class="verified-text pull-left">

                                    <a class="btn btn-circle btn-icon-only red" href="javascript:;">

                                        <i class="fa fa fa-close"></i>

                                    </a>

                                    Not Verified

                                </span>

                                


                                
                                <a href="{{url()}}/user/contactSave/7" class="btn btn-circle btn-icon-only bordered pull-right">

                                    <i class="fa fa-save"></i>

                                </a>

                                


                                <div class="profile" style="margin-top: 0px!important">

                                    
                                    <img src="{{URL::asset('profile/picture/Hiren_21547.jpg')}}">

                                    
                                </div>

                                <div class="profile_name" style="font-size: 25px;">Hiren Seller <i class="fa fa-plus-circle color: FAAE26"></i>

                                </div>

                                <div class="position">Ahmedabad </div>
                                <div class="company_name">TDS Company</div>
                                <div class="membership">

                                    
                                    <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta silver-member">SILVER SUPPLIER</a>

                                    
                                </div>

                            </div>

                            
                            <div class="todo-tasklist">

                                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                    <a href="{{url()}}/contactusers/contact/send/3/7"><i class="fa fa-home pull-left"></i>

                                    <div class="todo-tasklist-item-title"> CONNECT </div></a>

                                </div>



                                <!--<div class="todo-tasklist-item todo-tasklist-item-border-green">

                                    <a href="#message_modal" data-toggle="modal" data-target="#message_modal"> <i class="fa fa-cog  pull-left"></i>

                                    <div class="todo-tasklist-item-title"> Message </div></a>

                                </div>-->

                                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                    <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser(7)"> <i class="fa fa-cog  pull-left"></i>

                                    <div class="todo-tasklist-item-title"> Message </div></a>

                                </div>



                                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                

                                    <a href="javascript:void(0)" id="http://cryptdata.com/qt/view/user/hiren-seller-IJU-120056" onclick="showShare(id,'Hiren Seller')"> <i class="fa fa-info-circle pull-left"></i>

                                    <div class="todo-tasklist-item-title"> Share Profile </div></a>

                                </div>



                                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                    <a href="{{url()}}/endorse-user/3/7"> <i class="fa fa-info-circle pull-left"></i>

                                    <div class="todo-tasklist-item-title"> Endorse </div></a>

                                </div>



                                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                                    <a href="skype:?call"><i class="fa fa-skype pull-left"></i>

                                    <div class="todo-tasklist-item-title"> Skype </div></a>

                                </div>

                            </div>

                                
                            <div class="profile_social_link">

                                <div class="btn-group btn-group-solid">

                                    <a href="http://www.facebook.com/gachauhan" target="_blank"><button class="btn blue" type="button"><i class="fa fa-facebook"></i></button></a>

                                    <a href="" target="_blank"><button class="btn navy-blue" type="button"><i class="fa fa-twitter"></i></button></a>

                                    <a href="" target="_blank"><button class="btn light-grey" type="button"><i class="fa fa-linkedin "></i></button></a>

                                    <a href="http://www.youtube.com/gachauhan" target="_blank"><button class="btn orange" type="button"><i class="fa fa-youtube"></i></button></a>

                                </div>

                            </div>

                            <a href="#" onclick="addReport(id)" id="user-profile" class="report_page text-center">REPORT</a>

                        </div>



                    </div>

                    <div class="col-md-9 profile_details">

                        <div class="profile_details_inner">

                            <!-- Nav tabs -->



                            <div class="profile-details-block aboutme">

                                <div class="col-md-12  hide_print paddin-bottom">

                                  <div class="col-md-9 col-sm-9">

                                    <div class="row">

                                      &nbsp;

                                    </div>

                                  </div>

                                 

<!--

 <div class="col-md-3 col-sm-3 text-right">

                                   

 <div class="row">



                                      <div class="actions margin-top-10">

                                        <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>

                                          <ul class="dropdown-menu pull-right">

                                            <li> <a href="javascript:void(0)" id="http://cryptdata.com/qt/view/user/hiren-seller-IJU-120056" onclick="showShare(id,'Hiren Seller')">Share</a></li>

                                          </ul>

                                        </div>

                                      </div>

                                    </div>

                                  </div>

-->

                                </div>

                                

                                <h3>About Hiren Seller<span class="pull-right">User ID: IJU-120056</span>

                                </h3>

                                <div class="profile-block col-md-12">

                                    
                                    <h4>sds.</h4>

                                    
                                    <p>sdsad </p>



                                    <div class="mt-element-list">



                                        <div class="mt-list-container list-simple">

                                            <ul>

                                                
                                                <li class="mt-list-item">

                                                    

                                                    <span class="list-content">



<a class="btn dark btn-circle btn-md" href="javascript:;">

Airlines / Aviation </a>

                                                    
<a class="btn dark btn-circle btn-md" href="javascript:;">

                                                        Agriculture / Farming </a> 

                                                    
                                                     </span>

                                                </li>

                                                


                                                
                                                <li class="mt-list-item">

                                                    <i class="fa fa-map"></i>

                                                    <span class="list-content">Ahmedabad,Gujarat,India</span>

                                                </li>

                                                


                                                


                                                
                                            </ul>

                                        </div>

                                    </div>

                                    <div class="statistics-bar">

                                        <ul>

                                            <li class="padding-left" style="padding: 0px 14px!important;"><a href="#connections">1 Connections</a></li>

                                            <li class="padding-left" style="padding: 0px 14px!important;"><a href="#endorsements">0 Endorsements</a></li>

                                            <li class="padding-left" style="padding: 0px 14px!important;"><a href="#reviews">0 Reviews</a></li>

                                        </ul>

                                    </div>

                                  

                                </div>

                            </div>



                            <!-- categorie -->

                            
                            <div class="profile-details-block products">



                                <h3>PRODUCT CATEGORIES</h3>



                                
                                <div class="col-md-6 products-left">

                                    Air Chisels<br>

                                </div>

                                
                            </div>

                            


                            <!-- industries services -->

                            
                            <div class="profile-details-block products">



                                <h3>INDUSTRIAL SERVICES OFFERED</h3>



                                
                                <div class="col-md-6 products-left">

                                    Accommodation and Food Services<br>

                                </div>

                                
                            </div>

                            


                            <!-- employement -->

                            


                            <!-- education details -->

                            


                            <!-- certification & licenses details -->

                            


                            <!-- awards & honors -->

                            
                            <div class="profile-details-block education-history">



                                <h3>AWARDS &amp; HONORS</h3>

                                
                                <div class="single-employment first">

                                    <div class="col-md-6 employment-left"><span>dd, <strong>dd</strong></span></div>



                                    <div class="col-md-6 employment-right">d -  0000-00-00 </div><br>

                                </div><br>

                                
                            </div>

                            


                            <!-- organization -->

                            
                            <div class="profile-details-block education-history">



                                <h3>ORGANIZATION MEMBERSHIPS</h3>

                                
                                <div class="single-employment first">

                                    <div class="col-md-6 employment-left"><span>, <strong>a</strong></span></div>



                                    <div class="col-md-6 employment-right">0000-00-00 -

                                        
                                            0000-00-00

                                        
                                    </div><br>

                                </div><br>

                                
                                <div class="single-employment first">

                                    <div class="col-md-6 employment-left"><span>fgfd, <strong>fdgdfg</strong></span></div>



                                    <div class="col-md-6 employment-right">0000-00-00 -

                                        
                                            0000-00-00

                                        
                                    </div><br>

                                </div><br>

                                
                                <div class="single-employment first">

                                    <div class="col-md-6 employment-left"><span>sdf, <strong>sdf</strong></span></div>



                                    <div class="col-md-6 employment-right">2016-06-27 -

                                        
                                            2016-07-02

                                        
                                    </div><br>

                                </div><br>

                                
                            </div>

                            


                            <!-- Network Connections -->

                            
                            <div class="profile-details-block education-history">



                                <h3>CONNECTIONS</h3>



                                <div class="col-md-12" id="connections">

                                    <div class="portlet light portlet-fit">

                                        <div class="connection-body">

                                            <div class="mt-element-card mt-card-round mt-element-overlay">

                                                <div class="row">

                                                    <div class="owl-carousel product_demo owl-theme" style="opacity: 1; display: block;">

                                                    
                                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 536px; left: 0px; display: block;"><div class="owl-item" style="width: 268px;"><div class="">

                                                            <div class="mt-card-item">

                                                                <div class="mt-card-avatar mt-overlay-1">

                                                                    
                                                                    <img src="{{URL::asset('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">

                                                                    
                                                                </div>

                                                                <div class="mt-card-content">

                                                                    <h3 class="mt-card-name">Hiren Buye</h3>

                                                                    
                                                                    
                                                                </div>

                                                            </div>

                                                        </div></div></div></div>

                                                    
                                                    <div class="owl-controls clickable" style="display: none;"><div class="owl-buttons"><div class="owl-prev"><img src="{{URL::asset('images/left_arrow.png')}}" alt=""></div><div class="owl-next"><img src="{{URL::asset('images/right_arrow.png')}}" alt=""></div></div></div></div>

                                                </div>

                                                <div class="clearfix"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            
                            <!-- end -->



                            <!-- Endorsements -->

                            
                            <!-- end -->



                            <!--- Reviews Section -->

                            
                            <!-- end -->



                        </div>

                    </div>

                </div>


                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
<script>
    /* for show menu active */
    $("#dashboard-menu").addClass("active");
	/* end menu active */
    
</script>
<script src="{{URL::asset('metronic/apps/scripts/todo.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{URL::asset('js/owl-carousel/owl.carousel.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('js/animate.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('js/ng_responsive_tables.js')}}"></script>

<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="{{URL::asset('js/jquery.prettyPhoto.js')}}"></script>



<script>

  $(document).ready(function() {

    $("#owl-demo").owlCarousel({

    items : 3,

    navigation : false,

    slideSpeed : 300,

    paginationSpeed : 500,

    singleItem : true,

    autoPlay : true,

    pagination : false,

  });





  $("#testimonial").owlCarousel({

     navigation : true, // Show next and prev buttons

     pagination : false,

     slideSpeed : 300,

     paginationSpeed : 400,

     singleItem:true,

     navigationText : ["<img src='{{URL::asset('images/left_wh.png')}}' alt='' />", "<img src='{{URL::asset('images/rt_wh.png')}}' alt='' />"],



  });



  $(".product_demo").owlCarousel({

    navigation : true,

    slideSpeed : 300,

    paginationSpeed : 400,

    singleItem : false,

    pagination : false,

    items : 3,

    itemsDesktop : [1199, 4],

    itemsDesktopSmall : [991, 3],

    itemsTablet : [768, 2],

    itemsMobile : [479, 1],

     navigationText : ["<img src='{{URL::asset('images/left_arrow.png')}}' alt='' />", "<img src='{{URL::asset('images/right_arrow.png')}}' alt='' />"],



  });



  $(".profileslider").owlCarousel({

    navigation : false,

    pagination : true,

    slideSpeed : 300,

    paginationSpeed : 400,

    singleItem : false,

    items : 4,

    itemsDesktop : [1199, 4],

    itemsDesktopSmall : [991, 3],

    itemsTablet : [768, 2],

    itemsMobile : [479, 1]

  });





  $(".scrollar_btn").click(function(){

    $('html,body').animate({scrollTop: 630 }, 1000);

  });



  $('.scrolltotop').hide();



  $(".scrolltotop").click(function(){

     $('html,body').animate({scrollTop: 0 }, 1000);

  });







  $(window).scroll(function() {

    if ($(window).scrollTop() >= 500 ) {

       $('.scrolltotop').show('2000');

    } else {

         $('.scrolltotop').hide('2000');

    }

  });







  $(function loop_charch() {

     $(" .scrollar_btn btn-circle .circle").animate({height:50}, 1000)

     $(" .scrollar_btn btn-circle .circle").animate({height:40}, 1000,loop_charch);

  }); //loop_charch();





});



    $(window).on("load",function() {

        function fade() {

            var animation_height = $(window).innerHeight() * 0.25;

            var ratio = Math.round( (1 / animation_height) * 10000 ) / 10000;



            $('.fade').each(function() {

                var objectTop = $(this).offset().top;

                var windowBottom = $(window).scrollTop() + $(window).innerHeight();



                if ( objectTop < windowBottom ) {

                    if ( objectTop < windowBottom - animation_height ) {



                        $(this).css( {

                            transition: 'opacity 0.1s linear',

                            opacity: 1

                        } );



                    } else {



                        $(this).css( {

                            transition: 'opacity 0.25s linear',

                            opacity: (windowBottom - objectTop) * ratio

                        } );

                    }

                }

            });



        }

        $('.fade').css( 'opacity', 0 );

        fade();

        $(window).scroll(function() {fade();});

    });







    $(window).load(function(){

       if($(window).width() < 1600){

          $('.custom_nav').css({"padding-left":"20px",  "padding-right":"20px"});

       }

    });



    $(function(){

          $('table.responsive').ngResponsiveTables({

            smallPaddingCharNo: 13,

            mediumPaddingCharNo: 18,

            largePaddingCharNo: 30

          });

    });



     $(function(){



         var $quote = $(".profile_name");



         var $numWords = $quote.text().split("").length;



         if ($numWords > 15) {

             $quote.css("font-size", "25px");

         }





     });



    $(document).ready(function() {



        $('li.dropdown').hover(function() {

        $('ul.dropdown-menu', this).stop(true, true). fadeIn('fast', 'easeOutElastic');

        $(this).addClass('open');

        $(this).addClass('radius');

              },



        function() {

            $('ul.dropdown-menu', this).stop(true, true).fadeOut('fast', 'easeInElastic');

            $(this).removeClass('open');

            $(this).removeClass('radius');

        });



        $('.dropdown-menu').hover(function() {

            $(this).parent('li').stop(true, true).addClass('selectli');



        },



        function() {

            $(this).parent('li').stop(true, true).removeClass('selectli');

        });

    });









    $("#industry").autocomplete({

    source: ["Industry", "Boy", "Cat"],

    minLength: 0

}).focus(function () {

    $(this).autocomplete("search");

});



   $("#catagory").autocomplete({

    source: ["Catgory", "Boy", "Cat"],

    minLength: 0

}).focus(function () {

    $(this).autocomplete("search");

});



$('.infoeabout').click(function() {

   $('#autocomplete').trigger("focus"); //or "click", at least one should work

});



$(function () {

  $('[data-toggle="tooltip"]').tooltip()

});



    $(window).scroll(function(){

        if ( $(window).width() > 980 && $(window).scrollTop() > 0 ) {

            extraPadding = $(window).scrollTop() - 60;

            $('#stopMenu').css( "padding-top", extraPadding );

        } else {

            $('#stopMenu').css( "padding-top", "0" );

        }

    });







    $(document).ready(function(){





        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal', social_tools: false});







    });



    $('input').bind('copy paste', function (e) {

        e.preventDefault();

    });



</script>

<script>

// ------------------------------

// http://twitter.com/mattsince87

// ------------------------------



function scrollNav() {

  $('.statistics-bar a').click(function(){  

    //Toggle Class

    $(".active").removeClass("active");      

    $(this).closest('li').addClass("active");

    var theClass = $(this).attr("class");

    $('.'+theClass).parent('li').addClass('active');

    //Animate

    $('html, body').stop().animate({

        scrollTop: $( $(this).attr('href') ).offset().top - 160

    }, 400);

    return false;

  });

  $('.scrollTop a').scrollTop();

}

scrollNav();



function addReport(id) {

    console.log(id);

    $('#report_page').modal('show');

    var reasonType = $('#reason');

    if(id = "user_profile"){

        reasonType.html('<option value="This listing is spam">This listing is spam</option><option value="This information is incorrect">This information is incorrect</option><option value="This is a stolen item">This is a stolen item</option><option value="This product needs verification">This product needs verification</option>');

    }

}

</script>

@endsection
