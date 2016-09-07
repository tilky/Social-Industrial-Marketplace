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
<div class="col-md-3 col-sm-3 text-right">
                <div class="row">
                <div class="actions margin-top-10">

              <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>

                <ul class="dropdown-menu pull-right">

                  @if($quotes->status == 0)

                    <li>

                        <a href="{{url('supplierquote/accept')}}/{{$quotes->id}}">

                        <i class="fa fa-thumbs-o-up"></i> Accept Quote </a>

                    </li>

                    <li>

                        <a href="{{ URL::to('buyer/quote/ignore') }}/{{$current_user_id}}/{{$quotes->id}}">

                        <i class="fa fa-ban"></i> Ignore </a>

                    </li>

                    @endif

                  <li class="divider"> </li>

                  <li>

                    <a href="{{url('messages/create')}}?buyer={{$quotes->supplier_id}}">Message Supplier</a>

                </li>

                <li>

                    <a href="{{url('feedback/create')}}?receiver_id={{$quotes->supplierData->id}}">Feedback</a>

                </li>

                <li>

                    <a href="#" onclick="printDiv('print_section')">Print</a>

                </li>
                </ul>

              </div>

            </div>
                </div>
                </div>
</div>
</div>
<div class="row" >

        <div class="col-md-12 col-sm-12">

          <div class="portlet light request_page">

            <div class="col-md-12 col-sm-12 invoice_id">

                  <div class="row">

                   <div class="col-md-6 col-sm-6">

                  <div class="row">

<img src="{{URL::asset('images/indy_john_crm_logo.png')}}" height="68" width="210" />
<div class="clearfix"></div>
                            <h3 class="font-red bold uppercase pull-left">INDY JOHN INC.</h3>
                           <div class="clearfix"></div>
                         <div class="mt-comment-status">Los Angeles, CA, United States</div>
                         <div class="mt-comment-status">Los Angeles, CA, United States</div>
                         <div class="mt-comment-status">contact@indyjohn.com | indyJohn.cm</div>

                  </div>
<div class="row">


                            <h3 class="font-red bold uppercase pull-left">BILL TO</h3>
                            <div class="clearfix"></div>
                            <div class="h4 no-margin">Billing Name</div>
                            <div class="clearfix"></div>
                         <div class="mt-comment-status">Los Angeles, CA, United States</div>
                         <div class="mt-comment-status">Los Angeles, CA, United States</div>
                         <div class="mt-comment-status">contact@indyjohn.com | indyJohn.cm</div>

                  </div>
                  </div>

                  

                   <div class="col-md-6 col-sm-6 text-right">

                  <div class="row">

                  <h3> <strong>INVOICE</strong></h3>
                    
  
  

                     <h4> <strong> Number: </strong>IJT-12512</h4>
                     <h4> <strong> Date: </strong>June 5, 2016</h4>
                     <h4> <strong> User ID: </strong>INU-1125125</h4>

                     

                  </div>

                  </div>

                  </div>

                  </div>

                

                

               

            <div class="col-md-12 invoice_sheet margin-top-40">

            <div class="row">

            
<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dt-responsive invoice_table" width="100%" id="sample_1">

                <thead>

                    <tr>

                        <th>NUMBER</th>

                        <th class="text-center">DESCRIPTION</th>

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
                        <td><h5 class="pull-left"><strong>GOLD SUPPLIER ACCOUNT SUBSCRIPTION</strong></h5>
                         
                        
                        <div class="h5 pull-left">VALID FROM 6/28/2016 TO 7/27/2016</div>
                        <div class="clearfix"></div>
                       
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

               <h3 class="font-red bold uppercase paddin-npt">Additional Details:</h3>

               <h5>Thank you for your business.</h5>

            </div>

            <div class="pull-right col-sm-3 invioce_pricing">

               <h4 class="border_top border_bottom font_normal">Sub Total  <div class="pull-right">${{number_format($quotes->subtotal,2,'.',',')}}</div></h4>
               @if($quotes->salestax == 'Fixed Amount')
               <h4 class="border_bottom font_normal">Tax Applied (${{$quotes->salestax_amount}}/item)  <div class="pull-right">${{number_format($quotes->tax,2,'.',',')}}</div></h4>
               @elseif($quotes->salestax == 'Percent')
               <h4 class="border_bottom font_normal">Tax Applied ({{$quotes->salestax_amount}}%)  <div class="pull-right">${{number_format($quotes->tax,2,'.',',')}}</div></h4>
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

$("#buyer-tool-main-menu").addClass("active");

$('#buyer-tool-main-menu' ).click();

$('#buyer-tool-menu-arrow').addClass('open')

$('#quote-received-menu').addClass('active');

/* end menu active */



</script>



@endsection

