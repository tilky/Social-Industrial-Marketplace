@extends('buyer.app')



@section('content')

<link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('supplier-quotes')}}">Quotes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>

<div class="col-md-12 main_box " id="print_section">
<div class="row">

<div class="col-md-12 border2x_bottom hide_print">
<div class="col-md-9 col-sm-9">
                <div class="row">
<h3 class="page-title uppercase"> 
View Quote
</h3>
</div>
</div>

</div>
</div>
<div class="row" >

        <div class="col-md-12 col-sm-12">

          <div class="portlet light request_page">

            <div class="pull-left hide_print">

              <h2><strong>{{$quotes->buyerQuote->title}}</strong></h2>

              <h5>
                <strong>Product-Categories Selection:</strong> 
                @foreach($quotes->buyerQuote->categories as $index=>$category)
                    @if($index < 3)
                    @if($index == 0)
                    {{$category->category->name}}
                    @else
                    ,{{$category->category->name}}
                    @endif
                    @endif
                @endforeach
              </h5>

              <h5><strong>Submission Date:</strong> {{date('M d, Y',strtotime($quotes->buyerQuote->created_at))}} | <strong>Expiration Date:</strong> @if(strtotime($quotes->buyerQuote->expiry_date) > 0){{date('M d, Y',strtotime($quotes->buyerQuote->expiry_date))}} @else N/A @endif</h5>
              <h5><strong>Status:</strong> @if($quotes->buyerQuote->status == 1)Active @else Inactive @endif</h5>

            </div>


            <div class="clearfix"></div>

            <h5 class="border_bottom border_top padding-tittle hide_print"><strong>Quote Received:</strong> </h5>

            <div class="col-md-12 col-sm-12 invoice_id">

                  <div class="row">

                   <div class="col-md-6 col-sm-6">

                  <div class="row">

                  @if($quotes->sellerCompany != '')
                      @if($quotes->sellerCompany->logo != '')
                      <img class="img-responsive" src="{{url('')}}/{{$quotes->sellerCompany->logo}}" width="80">
                      @else
                      <img class="img-responsive" src="{{url('images/default-user.png')}}" width="80">
                      @endif
                  @else
                    <img class="img-responsive" src="{{url('images/default-user.png')}}" width="80">
                  @endif
                  <span class="label label-sm label-default"> NOT VERIFIED </span>
                  @if($quotes->company_tax_number != '')<h4>Tax ID: {{$quotes->company_tax_number}}</h4>@endif

                  

                  </div>

                  </div>

                  

                   <div class="col-md-6 col-sm-6 text-right">

                  <div class="row">

                  <h3> <strong>{{$quotes->quote_unique}} | {{date('M d, Y',strtotime($quotes->created_at))}}</strong></h3>

                     <h4> <strong> Buy Request ID: </strong>{{$quotes->buyerQuote->unique_number}}</h4>

                     @if($quotes->company_quote_number)<h4> <strong> Seller Quote Number: </strong>{{$quotes->company_quote_number}}</h4>@endif

                     <h4> <strong> Expiration Date: </strong>@if(strtotime($quotes->expiry_date) > 0 ) {{date('M d, Y',strtotime($quotes->expiry_date))}} @else N/A @endif</h4>

                  </div>

                  </div>

                  </div>

                  </div>

                

                <div class="col-md-12 col-sm-12 user_invoice">

                  <div class="row">

                    <div class="mt-comment">

                     

                        <div class="col-md-12 col-sm-12 about_user">

                        @if($quotes->buyerQuote->address != '')
                        <div class="col-md-5 col-sm-5 border_right">
                        @else
                        <div class="col-md-5 col-sm-5 border_right">
                        @endif

                            <div class="row">

                          <div class="col-md-5 col-sm-5 text-center user_info">

                            <div class="row">

                            <h3 class="font-red bold uppercase pull-left">Quote From:</h3>

                              <div class="mt-comment-img"> 
                                @if($quotes->sellerUser->userdetail->profile_picture != '')
                                <img class="img-circle" src="{{url('')}}/{{$quotes->sellerUser->userdetail->profile_picture}}" height="80px" width="80px"> 
                                @else
                                <img class="img-circle" src="{{url('images/default-user.png')}}" height="80px" width="80px">
                                @endif
                              </div>

                              <div class="mt-comment-text">
                                @if($quotes->sellerUser->quotetek_verify == 1)

                                VERIFIED MEMBER

                                @else

                                NOT VERIFIED

                                @endif
                              </div>

                              <div class="clearfix"></div>
                                @if($quotes->sellerUser->star == 'gold')

                                    <span class="label label-sm label-default label-warning"> 

                                        Gold Supplier 

                                    </span>

                                @elseif($quotes->sellerUser->star == 'silver')

                                    <span class="label label-sm label-default"> Silver Supplier </span>

                                @else

                                    <span class="label label-sm label-free "> Free Member </span>

                                @endif  
                              

                              <div class="clearfix"></div>

                              <ul>

                                <li><i class="fa fa-comment-o"></i> {{count($quotes->sellerUser->messages)}}</li>

                                <li><i class="glyphicon glyphicon-heart-empty"></i> {{count($quotes->sellerUser->endorsements)}}</li>

                                <li><i class="glyphicon glyphicon-star-empty"></i> {{count($quotes->sellerUser->reviews)}}</li>

                              </ul>

                              

                            </div>

                          </div>

                          <div class="col-md-7 col-sm-7">

                            <div class="row">

                          <div class="mt-comment-body">

                              <h3 class="font-red bold uppercase">&nbsp;</h3>

                                <div class="h3">{{$quotes->sellerUser->userdetail->first_name}} {{$quotes->sellerUser->userdetail->last_name}}</div>

                                <div class="clearfix"></div>

                                <div class="h4">
                                @if($quotes->sellerUser->userdetail->current_position != '') {{$quotes->sellerUser->userdetail->current_position}} @if($quotes->sellerCompany), {{$quotes->sellerCompany->name}}@endif @endif
                                </div>

                                <div class="clearfix"></div>

                                @if($quotes->sellerCompany)<div class="mt-comment-status">{{$quotes->sellerCompany->address}}</div> @endif

                                @if($quotes->sellerCompany)<div class="mt-comment-status">{{$quotes->sellerCompany->city}}, {{$quotes->sellerCompany->state}}, {{$quotes->sellerCompany->country}}</div>@endif

                                <div class="clearfix"></div>

                                @if($quotes->sellerUser->userdetail->phone != '')<div class="mt-comment-status">Phone {{$quotes->sellerUser->userdetail->phone}}</div>@endif

                                <div class="mt-comment-text"> Email Address: {{$quotes->sellerUser->email}}</div>

                                @if($quotes->sellerUser->userdetail->website_url != '')<div class="mt-comment-text">{{$quotes->sellerUser->userdetail->website_url}}</div>@endif

                            </div>

                            </div>

                            </div>

                          </div>

                          </div>


<div class="col-md-3 col-sm-3 border_right" style="min-height:241px;">

                              <div class="mt-comment-body">

                              <h3 class="font-red bold uppercase">Ship To:</h3>

                                <div class="h3">{{$quotes->user->userdetail->first_name}} {{$quotes->user->userdetail->last_name}}</div>

                                <div class="clearfix"></div>

                                <div class="h4">
                                Address line 1, line2
                                </div>

                                <div class="clearfix"></div>

                                <div class="mt-comment-status">City, State, Zip</div> 

                                <div class="mt-comment-status">Country</div>

                                <div class="clearfix"></div>

                               

                            </div>

                            </div>
                            @if($quotes->buyerQuote->address != '')
                            <div class="col-md-4 col-sm-4 border_right">
                            @else
                            <div class="col-md-4 col-sm-4">
                            @endif

                              <div class="mt-comment-body">

                              <h3 class="font-red bold uppercase">Quote For:</h3>

                                <div class="h3">{{$quotes->user->userdetail->first_name}} {{$quotes->user->userdetail->last_name}}</div>

                                <div class="clearfix"></div>

                                <div class="h4">
                                @if($quotes->user->userdetail->current_position != '') {{$quotes->user->userdetail->current_position}} @if($quotes->company), {{$quotes->company->name}}@endif @endif
                                </div>

                                <div class="clearfix"></div>

                                @if($quotes->company)<div class="mt-comment-status">{{$quotes->company->address}}</div> @endif

                                @if($quotes->company)<div class="mt-comment-status">{{$quotes->company->city}}, {{$quotes->company->state}}, {{$quotes->company->country}}</div>@endif

                                <div class="clearfix"></div>

                                @if($quotes->user->userdetail->phone != '')<div class="mt-comment-status">Phone {{$quotes->user->userdetail->phone}}</div>@endif

                                <div class="mt-comment-text"> Email Address: {{$quotes->user->email}}</div>

                                @if($quotes->user->userdetail->website_url != '')<div class="mt-comment-text">{{$quotes->user->userdetail->website_url}}</div>@endif

                            </div>

                            </div>

                            @if($quotes->buyerQuote->address != '')
                            <div class="col-md-4 col-sm-4">

                                <div class="mt-comment-body">

                                    <h3 class="font-red bold uppercase">Ship To:</h3>

                                    <div class="h3">{{$quotes->buyerQuote->title}}</div>

                                    <div class="clearfix"></div>

                                    <div class="mt-comment-status">Address: {{$quotes->buyerQuote->address}}</div>

                                    <div class="mt-comment-status">{{$quotes->buyerQuote->city}}, {{$quotes->buyerQuote->state}}, {{$quotes->buyerQuote->country}}</div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
                            @endif

                            <div class="col-md-12 col-sm-12 border_top border_bottom sender_notes">

                              <div class="mt-comment-body">

                               <h3 class="font-red bold uppercase no-margin">Additional Notes:</h3>

                              <h5>

                              {{$quotes->custom_note}}
                              </h5>

                              </div>

                              

                          </div>

                        </div>

                     

                      <div class="clearfix"></div>

                    </div>

                  </div>

                </div>

               

            <div class="col-md-12 invoice_sheet">

            <div class="row">

            <h3 class="font-red bold uppercase">Quote Details:</h3>
<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dt-responsive invoice_table" width="100%" id="sample_1">

                <thead>

                    <tr>

                        <th>NUMBER</th>

                        <th>ITEM DETAILS</th>

                        <th>QUALITY</th>

                        <th>PRICE</th>

                        <th>TOTAL</th>

                    </tr>

                </thead>

                <tbody>
                    @foreach($quotes->SupplierQuoteItems as $index=>$item)
                    <tr>

                        <td>{{$index+1}}</td>

                        <!--<td>{{$item->item_number}}</td>

                        <td><h4>{{$item->title}}</h4>

                        <p>{{$item->description}}</p></td>-->
                        <td><h5><span class="font-red">YEAR:</span> {{$item->year}}</h5> <h5><span class="font-red">COND:</span>{{$item->condition}}</h5>
                        <h5><span class="font-red">MNF:</span>{{$item->manufacturer}}</h5> <h5><span class="font-red">MODEL:</span>{{$item->model}}</h5>
                        <h5><span class="font-red">ITEM ID:</span> 44250</h5>
                        <div class="h5 pull-left align-left">{{$item->title}}</div>
                        @if($item->specification_file != '')<div class="h5 pull-left align-left"><a href="{{url('/')}}/{{$item->specification_file}}" download>Download Specifications File</a></div>@endif
                        <div class="clearfix"></div>
                        <div class="align-left">
                        @foreach($item->categories as $category)
                        <button class="btn btn-outline">{{$category['name']}}</button>
                        @endforeach 
                        @foreach($item->specification as $specification)
                        <button class="btn">{{$specification['keyword']}}</button>
                        @endforeach
                        </div>
                        </td>

                        <td>{{$item->qty}}</td>

                        <td>${{number_format($item->price,2,'.',',')}}</td>

                        <td>${{number_format($item->qty*$item->price,2,'.',',')}}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
</div>
                                   

            <div class="pull-left">

               <h3 class="font-red bold uppercase paddin-npt">Additional Sender Details:</h3>

               <h5>{{$quotes->payment_terms}}</h5>

            </div>

            <div class="pull-right col-sm-3 invioce_pricing">

               <h4 class="border_top border_bottom font_normal">Sub Total  <div class="pull-right">${{number_format($quotes->subtotal,2,'.',',')}}</div></h4>
               @if($quotes->salestax == 'Fixed Amount')
               <h4 class="border_bottom font_normal">Tax Applied (${{$quotes->salestax_amount}}/item)  <div class="pull-right">${{number_format($quotes->tax,2,'.',',')}}</div></h4>
               @elseif($quotes->salestax == 'Percent')
               <h4 class="border_bottom font_normal">Tax Applied ({{$quotes->salestax_amount}}%)  <div class="pull-right">${{number_format($quotes->tax,2,'.',',')}}</div></h4>
               @endif
                @if($quotes->shipping_charge == 'Yes')
                <h4 class="border_bottom font_normal">Shipping & Handling  <div class="pull-right">${{$quotes->shipping_charge_amount}}</div></h4>
                @endif
               <h3 class="border_bottom font_normal">Grand Total  <div class="pull-right">${{number_format($quotes->grandtotal,2,'.',',')}}</div></h3>                      

            </div>

             <div class="fix_bottom">

            <div class="col-md-12 text-center fix_bottom">

            <div class="row">
   <h4 class="font_normal"><img src="{{url('livesite/images/powered-by-indy-john.png')}}" height="25px" width="200px"></h4>
            </div>

            </div>

            <div class="clearfix"></div>

            </div>

            </div>

            </div>

            

            <div class="clearfix"></div>

          </div>

          <div class="clearfix"></div>

        </div>

      </div>

<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>

/* for show menu active */

$("#quote-main-menu").addClass("active");

$('#quote-main-menu' ).click();

$('#quote-menu-arrow').addClass('open')

$('#quote-sent-menu').addClass('active');

/* end menu active */



</script>



@endsection

