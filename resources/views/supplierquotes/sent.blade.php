@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Supplier Quotes</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-share-square-o"></i>  Quote Manager
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
                <div class="padding-top">
                        <p class="caption-helper">Thank you for using Indy John. These are the Quotes you sent out:  </p>
                    </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column text-center" id="sample_1">
                    <thead>
                    <tr>
                        <th style="text-align:center !important;"> Count </th>
                        <th style="text-align:center !important;"> Quote No. </th>
                        <th style="text-align:center !important;"> Buy Request No. </th>
                        <th style="text-align:center !important;"> Recipient </th>
                        <th style="text-align:center !important;"> Number of Items</th>
                        <th style="text-align:center !important;">Submission Date</th>
                        <th style="text-align:center !important;"> Status </th>
                        <th style="text-align:center !important;"> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($SupplierQuotes as $index=>$quote)
                    <tr class="odd gradeX">
                        <td style="text-align:center !important;">{{$index+1}}</td>
                        <td> {{$quote->quote_unique}} </td>
                        <td> <a href="{{url('request-product-quotes')}}/{{$quote->buyerQuote->id}}" target="_blank">{{ $quote->buyerQuote->unique_number}} </a></td>
                        <td><a href="{{url('home/user/profile')}}/{{$quote->buyerData->id}}" target="_blank">{{ $quote->buyerData->userdetail->first_name}} {{ $quote->buyerData->userdetail->last_name}}</a></td>
                        <td>
                            {{count($quote->SupplierQuoteItems)}}
                        </td>
                        <td>{{date('M d, Y',strtotime($quote->created_at))}}</td>
                        <td>
                            @if($quote->status == 0)
                            <span class="label label-sm label-success"> Pending </span>
                            @elseif($quote->status == 1)
                            <span class="label label-sm label-info"> Selected </span>
                            @else
                            <span class="label label-sm label-danger"> Rejected </span>
                            @endif
                        </td>
                        <td>
                        <div class="actions">
                            <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i>  </a>
                              <ul class="dropdown-menu pull-right">
                                <li> <a href="{{url('supplier-sent-quote/view')}}/{{$quote->id}}">View Sent Quote</a></li>
                                <li class="divider"> </li>
                                <li><a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$quote->buyerQuote->created_by}})">Message Buyer</a></li>
                                <li class="divider"> </li>
                                <li><a href="{{url('request-product-quotes')}}/{{$quote->buyerQuote->id}}" target="_blank">View Buy Request</a></li>
                              </ul>
                            </div>
                        </div>
                            
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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
    $("#quote-main-menu").addClass("active");
	$('#quote-main-menu' ).click();
	$('#quote-menu-arrow').addClass('open')
	$('#quote-sent-menu').addClass('active');
    /* end menu active */
    
    
</script>
@endsection
