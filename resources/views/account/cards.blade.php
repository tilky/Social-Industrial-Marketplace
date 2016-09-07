@extends('buyer.app')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Payment Information</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
  <div class="col-md-12 border2x_bottom">
    <div class="col-md-9 col-sm-9">
      <div class="row">
        <h3 class="page-title uppercase"> <i class="fa fa-money color-black"></i> Payment Information </h3>
      </div>
    </div>
    <div class="col-md-3 col-sm-3 text-right">
      <div class="actions margin-top-10"> <a href="javascript:void(0)" onclick="addNewCard();" class="btn btn-danger btn-sm"><i class="fa fa-plus red"></i> New Payment Method</a> </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12"> 
  
  <!-- BEGIN EXAMPLE TABLE PORTLET-->
  <div class="portlet-body"> @if (Session::has('error_message'))
    <div class="alert alert-danger" role="alert"> {!! Session::get('error_message') !!} </div>
    @endif
    @if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      {{ Session::get('message') }}</div>
    @endif
    <div class="row">
      <div class="col-md-12 margin-top-20">
        <div class="col-md-12">
          @if(count($cards) != 0)
            <h4> These are your Current Payment Details: </h4>
            <div class="row">
                <div class="col-md-12 margin-top-20">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                        <thead>
                        <tr>
                            <th>Card Type</th>
                            <th>Last 4</th>
                            <th>Exp. Month</th>
                            <th>Exp. Year</th>
                            <th> Date Last Used</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cards as $index=>$card)
                        <tr>
                            <input type="hidden" value="{{$card['id']}}" id="cardId_{{$index}}" name="card_id" />
                            <input type="hidden" value="{{$card['customer']}}" id="customerId_{{$index}}" name="customer_id" />
                            <td>{{$card['brand']}}</td>
                            <td>{{$card['last4']}}</td>
                            <td>{{$card['exp_month']}}</td>
                            <td>{{$card['exp_year']}}</td>
                            <td>&nbsp;</td>
                            <td><div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li> <a id="update_{{$index}}" href="javascript:void(0);" onclick="UpdateCard(id)">Update</a></li>
                                        <li class="divider"> </li>
                                        <li><a href="javascript:void(0);" id="delete_{{$index}}" onclick="DeleteCard(id)">Delete</a></li>
                                    </ul>
                                </div></td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <h4> Please ensure that your payment information is up to date to avoid service interruption. </h4><p />

                </div>
            </div>
            <form id="add-new-card" action="{{url('add/user/card')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
                <input type="hidden" name="card_token" value="" id="add_card_token_pop" />
                <input type="hidden" name="amount" value="30" />
                <input type="hidden" name="card_last_4" value="" id="add_card_last_4_pop" />
                <input type="hidden" name="card_type" id="add_card_type_pop" value="" />
                <input type="hidden" name="cardNumber" id="add_cardNumber_pop" value="" />
                <input type="hidden" name="cardExpiry" id="add_cardExpiry_pop" value="" />
                <input type="hidden" name="cardCVC" id="add_cardCVC_pop" value="" />
            </form>
            <form id="update-card-detail" action="{{url('update/user/card')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
                <input type="hidden" name="card_id" id="update_card_id" value="" />
                <input type="hidden" name="card_token" value="" id="update_card_token_pop" />
                <input type="hidden" name="cardExpiryMonth" id="update_card_exp_month_pop" value="" />
                <input type="hidden" name="cardExpiryYear" id="update_card_exp_year_pop" value="" />
                <input type="hidden" name="cardCVC" id="update_card_CVC_pop" value="" />
            </form>
          @else
            <h4> There are no active cards.</h4>
          @endif

        </div>
        <!-- END EXAMPLE TABLE PORTLET--> 
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="delete-card-modal" role="basic" aria-hidden="true" data-width="760">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      </div>
      <form action="{{url('delete/user/card')}}" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12"> Are you sure you want to delete this?
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
              <input type="hidden" name="card_id" id="delete_card_id" value="" />
              <input type="hidden" name="card_customer_id" id="delete_customer_id" value="" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="submit" id="user-credit-btn" class="btn yellow-crusta color-black btn-circle">Yes </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<script>
/* for show menu active */
$("#account-main-menu").addClass("active");
$('#account-main-menu' ).click();
$('#account-menu-arrow').addClass('open');
$('#account-payment-history-menu').addClass('active');
/* end menu active */
function UpdateCard(id)
{
    var values = id.split('_');
    var handler = StripeCheckout.configure({
        key: "{{env('STRIPE_PUBLIC_KEY', '')}}",
        image: "{{url('images/indy_john_crm_logo.png')}}",
        allow_remember_me: false,
        locale: 'auto',
        token: function(token) {
            
            App.blockUI({
                target: '#blockui_sample_1_portlet_body',
                animate: true
            });
            var card_id = $('#cardId_'+values[1]).val();
            $('#update_card_token_pop').val(token.id);
            $('#update_card_exp_month_pop').val(token.card.exp_month);
            $('#update_card_exp_year_pop').val(token.card.exp_year);
            $('#update_card_id').val(card_id);
            $('#update-card-detail').submit();
          // You can access the token ID with `token.id`.
          // Get the token ID to your server-side code for use.
        }
      });
    
    // Open Checkout with further options:
    handler.open({
      name: "{{url('/')}}",
      description: 'Update Card',
      email:"{{Auth::user()->email}}",
      allowRememberMe : false,
      panelLabel : "Update card"
    });
}
function addNewCard()
{
    
    var handler = StripeCheckout.configure({
        key: "{{env('STRIPE_PUBLIC_KEY', '')}}",
        image: "{{url('images/indy_john_crm_logo.png')}}",
        allow_remember_me: false,
        locale: 'auto',
        token: function(token) {
            
            App.blockUI({
                target: '#blockui_sample_1_portlet_body',
                animate: true
            });
            $('#add_card_token_pop').val(token.id);
            $('#add_card_last_4_pop').val(token.card.last4);
            $('#add_cardNumber_pop').val('');
            $('#add_cardExpiry_pop').val(token.card.exp_month+' / '+token.card.exp_year);
            $('#add_cardCVC_pop').val('');
            $('#add_card_type_pop').val(token.card.brand+' '+token.type);
            $('#add-new-card').submit();
          // You can access the token ID with `token.id`.
          // Get the token ID to your server-side code for use.
        }
      });
    
    // Open Checkout with further options:
    handler.open({
      name: "{{url('/')}}",
      description: 'Add New Card',
      email:"{{Auth::user()->email}}",
      allowRememberMe : false,
      panelLabel : "Add card"
    });
}
function DeleteCard(id)
{
    var values = id.split('_');
    var card_id = $('#cardId_'+values[1]).val();
    var customer_id = $('#customerId_'+values[1]).val();
    console.log(values[1]+'=>'+card_id+'=>'+customer_id);
    $('#delete_card_id').val(card_id);
    $('#delete_customer_id').val(customer_id);
    $('#delete-card-modal').modal('show');
}
</script> 
@endsection 
