@extends('buyer.app')

@section('content')
<style>
.media, .media-body{overflow: visible!important;}
.quotes-cat{margin: 0px 0px 5px 0px;}
</style>
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Quotes</span>
        </li>
    </ul>
</div>


<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-money color-black"> </i> Your Assigned Leads
</h3>

</div>
</div>
            
<div class="row">
                
<div class="col-md-12">
<div class="col-md-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body" style="float: left;width: 100%;padding: 10px!important;">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-12 paddin-npt">
                <p class="caption-helper" style="margin-top: 0px!important;">All Assigned Leads:</p>
                    <div class="col-md-6 col-sm-6 col-xs-6 margin-bottom-15">
                        <div class="row">
                        <select id="lead-select-filter" class="form-control" onchange="ApplyFilter();">
                            <option value="all">Filter By Lead Requests</option>
                            @foreach($supplierLeads as $lead)
                                @if(isset($_REQUEST['lead']))
                                    @if($lead->id == $_REQUEST['lead'])
                                        <option value="{{$lead->id}}" selected="">
                                            {{date('M d, y',strtotime($lead->created_at))}}
                                            @foreach($lead->categories as $cat_index=>$category)
                                            @if($cat_index == 0)
                                            {{$category->category->name}}
                                            @elseif($cat_index == 1)
                                            , {{$category->category->name}}
                                            @endif
                                        @endforeach
                                        </option>
                                    @else
                                        <option value="{{$lead->id}}">
                                            {{date('M d, y',strtotime($lead->created_at))}}
                                            @foreach($lead->categories as $cat_index=>$category)
                                            @if($cat_index == 0)
                                            {{$category->category->name}}
                                            @elseif($cat_index == 1)
                                            , {{$category->category->name}}
                                            @endif
                                        @endforeach
                                        </option>
                                    @endif
                                @else
                                <option value="{{$lead->id}}">
                                    {{date('M d, y',strtotime($lead->created_at))}}
                                    @foreach($lead->categories as $cat_index=>$category)
                                    @if($cat_index == 0)
                                    {{$category->category->name}}
                                    @elseif($cat_index == 1)
                                    , {{$category->category->name}}
                                    @endif
                                @endforeach


                                </option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                        
                       
                    </div>
                    
                    
                        
                        <div class="col-md-3 col-sm-3 col-xs-5 margin-bottom-15 pull-right"> 
                        <div class="row">
                        <select id="received-quote-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
                        <option>Sort By:</option>
                            <option value="created_at" @if($sellerquote_hidden_name == 'created_at') selected="selected" @endif>Submission Date</option>
                            <option value="expiry_date" @if($sellerquote_hidden_name == 'expiry_date') selected="selected" @endif>Expiration Date</option>
                            <option value="hidden_quotes" @if($sellerquote_hidden_name == 'hidden_quotes') selected="selected" @endif>Hidden</option>
                        </select>
                        @if($sellerquote_hidden_val == 'desc')
                            <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a>
                        @else
                            <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-up padding-top" style="float: left;padding-left: 5px;"></i></a>
                        @endif
                        </div>
                        </div>
                </div>
                
                @if($total > 0)
                @foreach ($quotes as $index=>$quote)
                <div class="tablebg">
                    <div class="colmd12 @if($quote->status == 0) lead-inactive @elseif(strtotime(date('Y-m-d')) > strtotime($quote->expiry_date)) lead-expire @else lead-active @endif ">
                        <div class="row">
                          <div class="col-md-3 text-center"> 
                            @if($quote->buyerUser->profile_picture != '')
                            <img src="{{url('')}}/{{$quote->buyerUser->profile_picture}}" alt="sell" class="img-circle" >
                            @else
                            <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                            @endif
                            <h5>{{$quote->buyerUser->first_name}} {{$quote->buyerUser->last_name}} @if($quote->buyerCompany != '') | {{$quote->buyerCompany->name}} @endif</h5>
                            <h5> @if($quote->buyer->quotetek_verify == 1) VERIFIED MEMBER @else NOT VERIFIED @endif </h5> 
                            
                            @if($quote->star == 'gold')
                            <button type="button" class="btn btn-circle btn-gold btn-block">GOLD SUPPLIER</button>
                            @elseif($quote->star == 'silver')
                            <button type="button" class="btn btn-circle btn-silver btn-block">SILVER SUPPLIER</button>
                            @else
                            <button type="button" class="btn btn-circle btn-free btn-block">FREE MEMBER</button>
                            @endif                                                                                                 
                            
                            <ul class="list-inline profile_num">
                              <li> <img alt="" src="{{url('images/cmnt_icon.png')}}"> {{count($quote->buyer->messages)}}</li>
                              <li> <img alt="" src="{{url('images/hrt_icon.png')}}"> {{count($quote->buyer->endorsements)}}</li>
                              <li> <img alt="" src="{{url('images/star_icon.png')}}"> {{count($quote->buyer->reviews)}}</li>
                            </ul>
                          </div>
                          <div class="col-md-7 received-lead-con">
                            <h4>{{$quote->title}}</h4>
                            <h5> Lead Received on: <strong>{{date('m/d/Y',strtotime($quote->created_at))}}</strong> | Lead Expiration Date: <strong>@if(strtotime($quote->expiry_date) > 0) {{date('m/d/Y',strtotime($quote->expiry_date))}} @else N/A @endif</strong> </h5>
                            <h5> Quote Type Matched: 
                                @if(count($quote->Equipments) > 0)
                                <strong>Equipment &gt; 
                                        @foreach($quote->Equipments as $index=>$Equipments)
                                                @if($index == 0)
                                                {{$Equipments->equipment->name}}
                                                @else
                                                ,{{$Equipments->equipment->name}}
                                                @endif
                                            @endforeach
                                </strong>
                                @endif
                                @if(count($quote->materialsToolings) > 0)
                                <strong>Instrumentation &gt; 
                                        @foreach($quote->materialsToolings as $index=>$materialsTooling)
                                                @if($index == 0)
                                                {{$materialsTooling->materialsTooling->name}}
                                                @else
                                                ,{{$materialsTooling->materialsTooling->name}}
                                                @endif
                                            @endforeach
                                </strong>
                                @endif
                                @if(count($quote->services) > 0)
                                <strong>Services &gt; 
                                        @foreach($quote->services as $index=>$service)
                                                @if($index == 0)
                                                @if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                @else
                                                ,@if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                @endif
                                            @endforeach
                                </strong>
                                @endif
                                @if(count($quote->softwares) > 0)
                                <strong>Software &gt; 
                                        @foreach($quote->softwares as $index=>$software)
                                                @if($index == 0)
                                                {{$software->software->name}}
                                                @else
                                                ,{{$software->software->name}}
                                                @endif
                                            @endforeach
                                </strong>
                                @endif
                                @if(count($quote->consumables) > 0)
                                <strong>Consumables/ Materials &gt; 
                                        @foreach($quote->consumables as $index=>$consumable)
                                                @if($index == 0)
                                                    @if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                @else
                                                ,@if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                @endif
                                            @endforeach
                                </strong>
                                @endif
                                
                            </h5>
                            <h5> Assigned in Team: 
                                <strong>
                                   TEAM NAME
                                </strong> 
                            <br />
                             | Assigned on Date: 
                                <strong>
                                   DATE OF ASSIGNMENT
                                </strong> 
                            </h5>
                            
                          </div>
                           <h5> Product-Category Matched: 
                                <strong>
                                    @foreach($quote->categories as $index=>$category)
                                        @if($index == 0)
                                        {{$category->category->name}}
                                        @else
                                        ,{{$category->category->name}}
                                        @endif
                                    @endforeach
                                </strong> 
                            </h5>
                            
                          <div class="col-md-2 text-center">
                            <!--<div class="price-text">$2500</div>-->
                            <!--<div class="price-text">N/A</div>-->
                            <div class="btn-group pull-right">
                              <div class="actions">
                                <div class="btn-group" >
                                    <a class="btn btn-circle btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                       
<!--
                                        <li>
                                            <a href="javascript:;" id="quoteview_{{$quote->id}}" onclick="ViewQuote(id);">
                                            <i class="icon-docs"></i> Quick View</a>
                                        </li> 
-->
                                        <li>
                                            <a href="">
                                            <i class="icon-eye"></i> View Lead</a>
                                        </li> 
                                                                               
                                        <li>
                                            <a href="{{ URL::to('supplier-quotes/create') }}/{{$quote->created_by}}/{{$quote->id}}">Send a Quote</a>
                                        </li>
                                        <li>
                                            <a href="{{url('messages/create')}}?buyer={{$quote->created_by}}">Message Supplier</a>
                                        </li>
                                        <li>
                                            <a href="">Message Assignee</a>
                                        </li>
                                        <li>
                                            <a href="{{url('feedback/create')}}?receiver_id={{$quote->created_by}}">Offer Feedback</a>
                                        </li>



                                    </ul>
                                </div>
                            </div>
                            </div>
                          </div>
                            <!--<div class="col-md-6 paddin-npt align-right">
                                    
                                    @if($user_access_level == 3)
                                    <a href="{{ route('request-product-quotes.show', $quote->id) }}" class="btn btn-circle hvr-bounce-to-right red">View Detail</a>
                                    <a href="{{ URL::to('supplier/quote/ignore') }}/{{$userData->user_id}}/{{$quote->id}}" class="btn btn-circle btn-sm red">Hide</a>
                                    <a href="{{ URL::to('supplier-quotes/create') }}/{{$quote->created_by}}/{{$quote->id}}" class="btn btn-circle btn-sm red">Send Quote</a>
                                    <a href="{{url('messages/create')}}?buyer={{$quote->created_by}}" class="btn btn-circle btn-sm red">Send Message</a>
                                    <a href="{{url('review/create')}}?receiver_id={{$quote->created_by}}" class="btn btn-circle btn-sm red">Star</a>
                                    <a href="{{url('feedback/create')}}?receiver_id={{$quote->created_by}}" class="btn btn-circle btn-sm red">Feedback</a>
                                    @endif
                                </div>-->
                        </div>
                        <div class="col-md-12 padding-top paddin-bottom grid-show" style="display: none;" id="quoteextend-{{$quote->id}}">
                        <div  class="align-right">
                            <a href="javascript:;" id="quoteview_{{$quote->id}}" onclick="CloseQuote(id);">
                                                <i class="fa fa-remove"></i> Close</a>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 paddin-npt padding-top">
                                <div class="col-md-9 paddin-npt">
                                    <h1 style="margin-top: 0px;">{{$quote->title}}</h1>
                                    <div style="padding: 5px 0px 20px;">
                                        {{$quote->specifications}}
                                    </div>
                                    <p><strong>Status: </strong>
                                        @if($quote->status == 1)
                                        Active
                                        @else
                                        Inactive
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-3 paddin-npt lbl-text">
                                    <p>Submit Date: {{date('Y-m-d',strtotime($quote->created_at))}}</p>
                                </div>
                            </div>
                            <div class="col-md-12 paddin-npt padding-top">
                                <label>Category | Industry :</label>
                                <table class="data-table" id="product-attribute-specs-table">
                                    <tr>
                                        <th class="lb-val">Categories</th>
                                        <td class="data-val">
                                            @foreach($quote->categories as $index=>$category)
                                                @if($index == 0)
                                                {{$category->category->name}}
                                                @else
                                                ,{{$category->category->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="lb-val">Industries</th>
                                        <td class="data-val">
                                            @foreach($quote->industries as $index=>$industry)
                                                @if($index == 0)
                                                {{$industry->industry->name}}
                                                @else
                                                ,{{$industry->industry->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12 paddin-npt padding-top">
                                <label>Quote Type :</label>
                                <table class="data-table" id="product-attribute-specs-table">
                                    <tr>
                                        <th class="lb-val">Equipment</th>
                                        <td class="data-val">
                                            @foreach($quote->Equipments as $index=>$Equipments)
                                                @if($index == 0)
                                                {{$Equipments->equipment->name}}
                                                @else
                                                ,{{$Equipments->equipment->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="lb-val">Instrumentation</th>
                                        <td class="data-val">
                                            @foreach($quote->materialsToolings as $index=>$materialsTooling)
                                                @if($index == 0)
                                                {{$materialsTooling->materialsTooling->name}}
                                                @else
                                                ,{{$materialsTooling->materialsTooling->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="lb-val">Services</th>
                                        <td class="data-val">
                                            @foreach($quote->services as $index=>$service)
                                                @if($index == 0)
                                                @if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                @else
                                                ,@if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="lb-val">Software</th>
                                        <td class="data-val">
                                            @foreach($quote->softwares as $index=>$software)
                                                @if($index == 0)
                                                {{$software->software->name}}
                                                @else
                                                ,{{$software->software->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="lb-val">Consumables/ Materials</th>
                                        <td class="data-val">
                                            @foreach($quote->consumables as $index=>$consumable)
                                                @if($index == 0)
                                                    @if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                @else
                                                ,@if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="padding-top" style="clear: both;"></div>
                            
                            <p>Expiration Date: {{$quote->expiry_date}}</p>
                            <p>Request Area: {{$quote->request_area}}</p>
                            <p>Privacy: {{$quote->privacy}}</p>
                            <p>Additional File: @if($quote->additional_file != '')<a href="{{url()}}/{{$quote->additional_file}}" download>Download File</a>@endif</p>
                            <p>Accreditations: 
                                @foreach($quote->accreditations as $index=>$accreditation)
                                    @if($index == 0)
                                    {{$accreditation->accreditation->name}}
                                    @else
                                    ,{{$accreditation->accreditation->name}}
                                    @endif
                                @endforeach
                            </p>
                            <p>Diversity Options: 
                                @foreach($quote->devirsities as $index=>$devirsitie)
                                    @if($index == 0)
                                    {{$devirsitie->diversity->name}}
                                    @else
                                    ,{{$devirsitie->diversity->name}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                
                @endforeach
                @else
                <div class="col-md-12 padding-top paddin-bottom" style="background: #fff;margin: 10px 0px;">
                    <p>You have not received any leads yet. Submit a new Lead Request.</p>
                </div>
                @endif
                
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a>
                    </li>
                    @endif
                </ul>
        <a href="{{url('supplier-leads/create')}}" class="btn btn-circle btn-sm red font-wh text-upper large_button"><i class="fa fa-plus"></i> Get More Leads, Submit a Lead Request.</a>
      </div>
      
    </div>
        
    </div>
    </div>            
    
      

<script>
    /* for show menu active */
    $("#quote-main-menu").addClass("active");
	$('#quote-main-menu' ).click();
	$('#quote-menu-arrow').addClass('open')
	$('#quote-view-menu').addClass('active');
    /* end menu active */
    
    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        jQuery('#deleteConfirmation .modal-body #objectId').val( id );
    });

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                $( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();
            }
        });
    });
    function ApplyFilter()
    {
        var order_name = $('#received-quote-filter').val();
        var order_dir = '{{$sellerquote_hidden_val}}';
        var lead = $('#lead-select-filter').val();
        if(order_dir == 'asc')
        {
            var redirect_url = '{{url("request-product-quotes")}}?sellerquote_order_name='+order_name+'&sellerquote_order_by=desc&lead='+lead;    
        }
        else
        {
            var redirect_url = '{{url("request-product-quotes")}}?sellerquote_order_name='+order_name+'&sellerquote_order_by=asc&lead='+lead;
        }
        window.location.href = redirect_url;
    } 
    function ViewQuote(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $( "#quoteextend-"+divId ).slideDown(300);
}
function CloseQuote(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $( "#quoteextend-"+divId ).slideUp(300);
}
</script>
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection
