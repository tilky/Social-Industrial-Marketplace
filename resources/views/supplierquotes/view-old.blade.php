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
<h3 class="page-title"> View Quote
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="invoice-content-2 bordered">
            <div class="row invoice-head">
                <div class="col-md-7 col-xs-6">
                    <div class="invoice-logo">
                        <img src="{{url('')}}/public/images/indy_jones.png" class="img-responsive" alt="" />
                        <h1 class="uppercase">Invoice</h1>
                    </div>
                </div>
                <div class="col-md-5 col-xs-6">
                    <div class="company-address">
                        <span class="bold uppercase">Indy John</span>
                        <br/> 25, Lorem Lis Street, Orange C
                        <br/> California, US
                        <br/>
                        <span class="bold">T</span> 1800 123 456
                        <br/>
                        <span class="bold">E</span> support@indyjohn
                        <br/>
                        <span class="bold">W</span> www.keenthemes.com </div>
                </div>
            </div>
            <div class="row invoice-cust-add">
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Customer</h2>
                    <p class="invoice-desc">{{$userData->first_name}} {{$userData->last_name}}</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Date</h2>
                    <p class="invoice-desc">{{date('M d, Y',strtotime($quotes->created_at))}}</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Estimated Delivery by</h2>
                    <p class="invoice-desc">{{date('M d, Y',strtotime($quotes->estimated_delivery))}}</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Address</h2>
                    <p class="invoice-desc inv-address">
                        {{$userData->address1}} 
                        @if($userData->address2 != ''),{{$userData->address2}} @endif
                        @if($userData->city != ''),{{$userData->city}} @endif
                        @if($userData->state != ''),{{$userData->state}} @endif
                        @if($userData->country != ''),{{$userData->country}} @endif
                    </p>
                </div>
            </div>
            <div class="row invoice-body">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="invoice-title uppercase">Description</th>
                                <th class="invoice-title uppercase text-center">Hours</th>
                                <th class="invoice-title uppercase text-center">Qty</th>
                                <th class="invoice-title uppercase text-center">Price</th>
                                <th class="invoice-title uppercase text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes->SupplierQuoteItems as $index=>$item)
                                <tr>
                                    <td>
                                        <h3>{{$item->title}}</h3>
                                        <p> {{$item->description}} </p>
                                    </td>
                                    <td class="text-center sbold">{{$quotes->estimated_time}}</td>
                                    <td class="text-center sbold">{{$item->qty}}</td>
                                    <td class="text-center sbold">{{$item->price}}$</td>
                                    <td class="text-center sbold">{{number_format($item->qty*$item->price,'2','.',',')}}$</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row invoice-subtotal">
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Subtotal</h2>
                    <p class="invoice-desc">{{number_format($quotes->subtotal,'2','.',',')}}$</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Tax (0%)</h2>
                    <p class="invoice-desc">0$</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Shipping Fee</h2>
                    <p class="invoice-desc">{{number_format($quotes->shipping_fee,'2','.',',')}}$</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Total</h2>
                    <p class="invoice-desc grand-total">{{number_format($quotes->grandtotal,'2','.',',')}}$</p>
                </div>
            </div>
            <div class="row invoice-cust-add">
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Shipped Via</h2>
                    <p class="invoice-desc">{{$quotes->shipped_via}}</p>
                </div>
                <div class="col-xs-3">
                    <h2 class="invoice-title uppercase">Payment Terms</h2>
                    <p class="invoice-desc">{{$quotes->payment_terms}}</p>
                </div>
                <div class="col-xs-6">
                    <h2 class="invoice-title uppercase">Payment Via</h2>
                    <p class="invoice-desc inv-address">
                        {{$quotes->payment_via}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-circle btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
</div>
<script>
/* for show menu active */
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open')
$('#quote-received-menu').addClass('active');
/* end menu active */

</script>

@endsection
