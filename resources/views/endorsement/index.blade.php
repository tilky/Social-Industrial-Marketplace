@extends('buyer.app')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url()}}/user-dashboard">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Endorsements Received</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-thumbs-up color-black"> </i> Manage Endorsements </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        <div class="portlet-body">
          <div class="tabbable-line">
            <ul class="nav nav-tabs">
              <li class="active"> <a class="color-black" href="#tab_1_1" data-toggle="tab">
                <h5 class="bold uppercase"> Endorsements Received </h5>
                </a> </li>
              <li> <a class="color-black" href="{{url('endorse-sent')}}" >
                <h5 class="bold uppercase"> Endorsed Users </h5>
                </a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade active in" id="tab_1_1"> @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  {{ Session::get('message') }}</div>
                @endif
                <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none"> @if(count($endorsements) > 0)
                  @foreach($endorsements as $endorsement)
                   @if($endorsement->sender->access_level == 4)<div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                <p class="text-right res_found">&nbsp;</p>
                <div class="mt-comment result">
                  <div class="mt-comment-img"> <a class="pull-left" href="{{url('company/profile')}}/{{$endorsement->sender->companydetail->id}}" target="_blank"> @if($endorsement->sender->companydetail->logo != '') <img src="{{url('')}}/{{$endorsement->sender->companydetail->logo}}" alt="sell" class="img-circle" width="50px"> @else <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px"> @endif </a>
                  </div>
                    <div class="mt-comment-body">
                    <div class="mt-comment-info"> <a class="pull-left" href="{{url('company/profile')}}/{{$endorsement->sender->companydetail->id}}" target="_blank">
                      <h3 class="media-heading">{{$endorsement->sender->companydetail->name}}</h3>
                      </a> <div class="actions pull-right">
                        <div class="btn-group"> <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                          <ul class="dropdown-menu pull-right">
                            <li> <a href="{{url('company/profile')}}/{{$endorsement->sender->companydetail->id}}" target="_blank"> <i class="icon-eye"></i> View Profile </a> </li>
                            <li class="divider"> </li>
                            <li> <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$endorsement->sender->companydetail->user_id}})"> <i class="fa fa-envelope"></i> Message </a> </li>
                          </ul>
                        </div>
                      </div></div>
                      <div class="text-muted"><small>Endorsed on {!! $endorsement->created_at->diffForHumans() !!}</small></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
              </div>
                    @else 
                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                <p class="text-right res_found">&nbsp;</p>
                <div class="mt-comment result">
                  <div class="mt-comment-img"><a class="pull-left" href="{{url('home/user/profile')}}/{{$endorsement->sender_id}}" target="_blank"> @if($endorsement->sender_avatar != '') <img src="{{url('')}}/{{$endorsement->sender_avatar}}" alt="sell" class="img-circle" width="50px"> @else <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px"> @endif </a>
                  </div>
                    <div class="mt-comment-body">
                    <div class="mt-comment-info"> <a class="pull-left" href="{{url('home/user/profile')}}/{{$endorsement->sender_id}}" target="_blank">
                      <h3 class="media-heading">{{$endorsement->sendername}}</h3>
                      </a> <div class="actions pull-right">
                        <div class="btn-group"> <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                          <ul class="dropdown-menu pull-right">
                            <li> <a href="{{url('home/user/profile')}}/{{$endorsement->sender_id}}" target="_blank"> <i class="icon-eye"></i> View Profile </a> </li>
                            <li class="divider"> </li>
                            <li> <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$endorsement->sender_id}})"> <i class="fa fa-envelope"></i> Message </a> </li>
                          </ul>
                        </div>
                      </div></div> <span>{{$endorsement->sender->userdetail->current_position}} @if($endorsement->companyname != '')at {{$endorsement->companyname}}@endif</span>
                      <div class="text-muted"><small>Endorsed on {!! $endorsement->created_at->diffForHumans() !!}</small></div>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    @endif 
                  @endforeach
                  @else
                 <p class="text-center res_found"> No endorsement sent</p>
                  @endif </div>
                <ul class="pager">
                  @if($previousPageUrl != '')
                  <li class="previous"> <a href="{{$previousPageUrl}}"> <i class="fa fa-arrow-left"></i> Prev </a> </li>
                  @endif
                  @if($nextPageUrl != '')
                  <li class="next"> <a href="{{$nextPageUrl}}"> Next <i class="fa fa-arrow-right"></i> </a> </li>
                  @endif
                </ul>
              </div>
              <div class="tab-pane fade" id="tab_1_2"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END EXAMPLE TABLE PORTLET--> 

<script>
    /* for show menu active */
     $("#contact-list-main-menu").addClass("active");
	$('#contact-list-main-menu' ).click();
    $('#contact-list-menu-arrow').addClass('open');
	$('#endorsement-receive-menu').addClass('active');
    /* end menu active */   
</script> 
@endsection 
