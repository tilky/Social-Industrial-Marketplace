@extends('buyer.app')

@section('content')
<style>
    .media, .media-body{overflow: visible!important;}
</style>
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
        <li> <span>Received Product Quotes</span> </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom hide_print">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <h3 class="page-title uppercase"> Assigned Quotes </h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-right">
                <!--div class="row">
                    <div class="actions margin-top-15"> <select id="received-quote-filter"  class="form-control" >
                            <option >Sort By:</option>
                            <option value="" selected="selected">Team</option>
                            <option value="">Most Recent</option>
                            <option value="">Oldest</option>
                        </select> </div>
                </div-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"> @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                {{ Session::get('message') }}</div>
            @endif
            <div class="col-md-12 margin-top-15">
                <h3>Quotes assign to you</h3><br />
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 margin-bottom-15">
                        <div class="row">
                            {{--<select id="received-quote-filter" onchange="ApplyFilterQuote();" class="form-control col-md-8" style="float: left;">
                                <option value="">Filter By Buy Request</option>
                                @foreach($userquotes as $userquote)
                                <option value="{{$userquote->id}}" @if($userquote->id == $current_quote_id) selected="selected" @endif>{{$userquote->title}}</option>
                                @endforeach
                            </select>--}}
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-5 margin-bottom-15 pull-right">

                        <div class="row">
                            {{--<select id="received-quote-filter" onchange="" class="form-control" style="width: 90%;float: left;">
                                <option >Sort By:</option>
                                <option value="created_at" selected="selected">Submission Date</option>
                                <option value="expiry_date">Expiration Date</option>
                                <option value="hidden_quotes">Hidden</option>
                            </select>
                            <a href="javascript:void(0)" onclick=""><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>

            @if($total > 0)
            @foreach ($buyerQuotes as $index=>$quote)
            <div class="tablebg">
                <div class="colmd12 @if($quote->buy_request->status == 0) lead-inactive @elseif(strtotime(date('Y-m-d')) > strtotime($quote->buy_request->expiry_date)) lead-expire @else lead-active @endif ">
                    <div class="row">
                        <div class="col-md-3 text-center"> @if($quote->teamUser->profile_picture != '') <img src="{{url('')}}/{{$quote->teamUser->profile_picture}}" alt="sell" class="img-circle" width="70px"> @else <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px"> @endif
                            <h5>{{$quote->teamUser->first_name}} {{$quote->teamUser->last_name}} @if($quote->buyerCompany != '') | {{$quote->buyerCompany->name}} @endif</h5>
                            <h5> @if($quote->teamUser->quotetek_verify == 1) VERIFIED MEMBER @else NOT VERIFIED @endif </h5>
                            @if($quote->star == 'gold')
                            <button type="button" class="btn btn-circle btn-gold btn-block">GOLD SUPPLIER</button>
                            @elseif($quote->star == 'silver')
                            <button type="button" class="btn btn-circle btn-silver btn-block">SILVER SUPPLIER</button>
                            @else
                            <button type="button" class="btn btn-circle btn-free btn-block">FREE MEMBER</button>
                            @endif
                            <ul class="list-inline profile_num">
                                <li> <img alt="" src="{{url('images/cmnt_icon.png')}}"> {{count($quote->teamUser->messages)}}</li>
                                <li> <img alt="" src="{{url('images/hrt_icon.png')}}"> {{count($quote->teamUser->endorsements)}}</li>
                                <li> <img alt="" src="{{url('images/star_icon.png')}}"> {{count($quote->teamUser->reviews)}}</li>
                            </ul>
                        </div>

                        <div class="col-md-7 received-lead-con">
                            <h4>{{$quote->title}}</h4>
                            <h5> {{$quote->action_status}}Quote date: <strong>{{date('m/d/Y',strtotime($quote->created_at))}}</strong> | Buy Request date: <strong>{{date('m/d/Y',strtotime($quote->buy_request->created_at))}}</strong> </h5>
                            <h5>
                                 </h5>
                            <h5> </h5>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="page-actions">
                                <div class="btn-group open">
                                    <button type="button" class="btn btn_yellow hvr-bounce-to-right dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{url('request-product-quotes')}}/{{$quote['buyer_quote_id']}}"><i class="fa fa-eye"></i> View Buy Request</a></li>
                                        @if($quote->action_status == "pending")
                                        <li class="divider"> </li>
                                        <li> <a href="{{url('accept-product-quotes-team')}}/{{$quote['quote_id']}}"> <i class="fa fa-thumbs-o-up"></i> Accept Quote </a> </li>
                                        @endif
                                        <li class="divider"> </li>
                                        <li> <a href="#contact_seller" id="{{$quote['supplier_id']}}" onclick='setSupplierReceiver(id)' data-toggle="modal" data-target="#contact_seller">Message Supplier</a> </li>
                                        <li class="divider"> </li>
                                        <li> <a href="#contact_seller" id="{{$quote['supplier_id']}}" onclick='setManagerReceiver(id)' data-toggle="modal" data-target="#contact_seller">Message Team Manager</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-12 padding-top paddin-bottom" style="background: #fff;margin: 10px 0px;">
                <p>You have not received any Quotes yet.</p>
            </div>
            @endif
            <ul class="pager">
                @if($previousPageUrl != '')
                <li class="previous"> <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a> </li>
                @endif
                @if($nextPageUrl != '')
                <li class="next"> <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a> </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script>
    $("#team-purchasing").addClass("active");
    $('#team-purchasing-menu-arrow').addClass('open');
    $('#assigned-quotes').addClass('active');

    function ApplyFilterQuote()
    {
        var quote_id = $('#received-quote-filter').val();
        var redirect_url = '{{url("assigned-quotes")}}?quote_id='+quote_id;
        window.location.href = redirect_url;
    }

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function setSupplierReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO SUPPLIER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function setManagerReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MANAGER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function sendTeamMemberMessage(){
        var subject =  document.getElementById('subject').value;
        var body =  document.getElementById('message_body').value;
        var receiver =  document.getElementById('message_receiver').value;
        var baseurl = "{{url('member/message/send')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                subject : subject,
                body : body,
                receiver_id : receiver
                //reportType : reportType
            },
            success:function(data) {
                $('#contact_seller').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }
</script>
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection
