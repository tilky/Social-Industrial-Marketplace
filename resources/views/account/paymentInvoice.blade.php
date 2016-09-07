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
            <a href="{{url('supplier-quotes')}}">Invoices</a>
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
View Invoice
</h3>
</div>
</div>
<div class="col-md-3 col-sm-3 text-right">
                <div class="row">
                <div class="actions margin-top-10">

              <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
<ul class="dropdown-menu pull-right">
                
                
                <li><a href="#" onclick="printDiv('print_section')">Print</a></li>
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

<img src="{{url()}}/images/indy_john_crm_logo.png" height="68" width="210" />
<div class="clearfix"></div>
                          
                            <h3 class="bold uppercase pull-left">INDY JOHN INC.</h3>
                           <div class="clearfix"></div>
                         <div class="mt-comment-status">P.O. Box 86023 <br>
                         Los Angeles, CA 90086-0023 USA<br> support@IndyJohn.com | IndyJohn.com</div>
                         
                      

                  </div>
<div class="row">

                            <h3 class="font-red bold uppercase pull-left">BILL TO</h3>
                            <div class="clearfix"></div>

<h3 class="bold uppercase pull-left">{{$paymentDetail->user->userdetail->first_name}} {{$paymentDetail->user->userdetail->last_name}}</h3>
 <div class="clearfix"></div>
                            <div class="h4 no-margin">@if($paymentDetail->userCompany != '') {{$paymentDetail->userCompany->name}} @endif</div>
 <div class="clearfix"></div>
                            <div class="clearfix"></div>
                         <div class="mt-comment-status">{{$paymentDetail->user->userdetail->address1}}</div>
                         @if($paymentDetail->user->userdetail->address2 != '')<div class="mt-comment-status">{{$paymentDetail->user->userdetail->address2}}</div>@endif
                         <div class="mt-comment-status">{{$paymentDetail->user->userdetail->city}}, {{$paymentDetail->user->userdetail->state}}, {{$paymentDetail->user->userdetail->country}} </div>
                         <div class="mt-comment-status">
                         {{$paymentDetail->user->userdetail->phone}} | {{$paymentDetail->user->email}} 
                         @if($paymentDetail->user->userdetail->website_url != '')| {{$paymentDetail->user->userdetail->website_url}}@endif
                         </div>

                  </div>
                  </div>

                  

                   <div class="col-md-6 col-sm-6 text-right">

                  <div class="row">

                  <h3> <strong>INVOICE</strong></h3>
                    
  
  

                     <h4> <strong> Number: </strong>{{$paymentDetail->unique_number}}<!--Invoice number--></h4>
                     <h4> <strong> Date: </strong>{{date('M d, Y',strtotime($paymentDetail->created_at))}}<!--date of order--></h4>
                     <h4> <strong> User ID: </strong>{{$paymentDetail->user->unique_number}} <!--user number--></h4>

                     

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

                    <tr>
                        <td>01</td>
                        <td>{{$paymentDetail->detail}} ( For {{$paymentDetail->paidFor->userdetail->first_name}} {{$paymentDetail->paidFor->userdetail->last_name}} [ {{$paymentDetail->paidFor->unique_number}} ] )</td>
                        <td>01</td>
                        <td>${{number_format($paymentDetail->amount,2,'.',',')}}</td>
                        <td>${{number_format($paymentDetail->amount,2,'.',',')}}</td>
                    </tr>

            </table>
</div>
                                   

            <div class="pull-left">

               <h3 class="font-red bold uppercase paddin-npt">Additional Details:</h3>

               <h5>Thank you for your business.</h5>

            </div>

            <div class="pull-right col-sm-3 invioce_pricing">

               <h4 class="border_top border_bottom font_normal">Sub Total  <div class="pull-right">${{number_format($paymentDetail->amount,2,'.',',')}}</div></h4>
               <h3 class="border_bottom font_normal">Grand Total  <div class="pull-right">${{number_format($paymentDetail->amount,2,'.',',')}}</div></h3>                      

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

$("#account-main-menu").addClass("active");

$('#account-main-menu' ).click();

$('#account-main-menu-arrow').addClass('open');

$('#account-payment-history-menu').addClass('active');

/* end menu active */



</script>



@endsection

